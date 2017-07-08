<?php

namespace backend\controllers;

use Yii;
use backend\models\Modulo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ModuloController implements the CRUD actions for Modulo model.
 */
class ModuloController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionLoadmodulo(){
        
        $mod_id = Yii::$app->request->post('mod_id');     
        $model  = new \backend\models\ModuloPostHasModuloRegistro();
        $modulo = $this->findModel($mod_id);
        $post   = new \backend\models\ModuloPost();
               
        if($post->load(Yii::$app->request->post())){
            $post->mod_post_fechacreacion     =  date("Y-m-d H:i:s");
            $post->mod_post_fechamodificacion =  date("Y-m-d H:i:s");
            $post->mod_post_titulo            =  'Ha creado';
            $post->mod_id                     =  $mod_id;
            if($post->save()){
             
                foreach ($_POST['ModuloPostHasModuloRegistro'] as $index => $reg){
                    $mod  = new \backend\models\ModuloPostHasModuloRegistro();
                    $mod->mod_post_id = $post->mod_post_id;
                    $mod->mod_reg_id  = $index;
                    $mod->contenido   = $reg;
                    $mod->insert(); 
                }    
                 echo json_encode([
                    'status'=>'save'
                ]);
                exit; 
            }
            //print_r($_POST);
            //exit;
            
            echo json_encode([
                'status'=>'false',
                'div'=>$this->renderAjax('modulo',['modulo'=>$modulo,'model'=>$model,'post'=>$post])
            ]);
            exit;
        }

        echo json_encode([
            'status'=>'success',
            'div'=>$this->renderAjax('modulo',['modulo'=>$modulo,'model'=>$model,'post'=>$post])
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Modulo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCreatecomentario(){
        $model = new \backend\models\ModuloPostComentario();
        if($model->load(Yii::$app->request->post())){
            $model->com_fechacreacion     = date("Y-m-d H:i:s");
            $model->com_fechamodificacion = date("Y-m-d H:i:s");
            $model->com_usuario_id        = Yii::$app->user->id;
            if($model->save()){
                echo json_encode([
                    'status'=>'success',
                    'id'=> $model->com_mod_post_id
                ]);
                exit;
            }
            echo json_encode([
                'failed'=>'success',
                'msj'   => 'Algo ocurrio al comentar!.'
            ]);
            exit;
            
        }
        
    }
    
    public function actionAgregarusuario(){
        $model = new \backend\models\ModuloPostHasUsuario();
        if($model->load(Yii::$app->request->post())){
            $model->fecha_creacion     = date("Y-m-d H:i:s");
            $model->fecha_modificacion = date("Y-m-d H:i:s");
            $model->activo             = 1;
            if($model->save()){
                echo json_encode([
                    'status'=> 'success',
                    'id'    => $model->modulo_post_mod_post_id
                ]);
                exit;
            }
            echo json_encode([
                'failed'=>'success',
                'msj'   => 'Algo ocurrio al comentar!.'
            ]);
            exit;
        }
        
    }
    
    function actionUploadfile(){
        $model = new \backend\models\UploadForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                
                $file = new \backend\models\ModuloPostFiles();
                $file->file_post_id           =  $model->parent_id;
                $file->file_nombre            =  $model->imageFiles[0]->name;
                $file->file_fechacreacion     =  date("Y-m-d H:i:s");
                $file->file_fechamodificacion =  date("Y-m-d H:i:s");
                $file->file_usu_id            =  Yii::$app->user->id;
                $file->file_size              =  $model->imageFiles[0]->size;
                $file->file_tipo              =  $model->imageFiles[0]->type;
                
                if($file->save()){
                    echo json_encode([
                        'status'=>'save',
                        'id'=>$model->parent_id
                    ]);
                    exit;
                }
            }
            echo json_encode([
                'status'=>'failed',
                'form' => $this->renderAjax('_formUpload',['model'=>$model])
                ]);
            exit;
        }
        echo json_encode([
            'status'=>'success',
            'form' => $this->renderAjax('_formUpload',['model'=>$model])
            ]);
        exit;
    }
}
