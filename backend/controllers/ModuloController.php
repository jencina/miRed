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
    
    public function actionGetpost(){
                /*
                $limit  = Yii::$app->request->get('limit');
                $offset = Yii::$app->request->get('offset');    
                
                
                $post = \backend\models\ModuloPost::find()
                ->where(['mod_activo'=>1])
                ->andWhere(['or',['mod_usu_id' => Yii::$app->user->id],['mod_post_asignado_usu_id' => Yii::$app->user->id]])
                ->limit($limit)  //hasta
                ->offset($offset) //desde
                ->orderBy([ 'mod_post_fechamodificacion' => SORT_DESC])
                ->all();
                
                $count = \backend\models\ModuloPost::find()
                ->where(['mod_activo'=>1])
                ->andWhere(['or',['mod_usu_id' => Yii::$app->user->id],['mod_post_asignado_usu_id' => Yii::$app->user->id]])
                ->count('*');
                */
                
                
                $post = new ActiveDataProvider([
                    'query' => \backend\models\ModuloPost::find()
                        ->where(['mod_activo'=>1])
                        ->andWhere(['or',['mod_usu_id' => Yii::$app->user->id],['mod_post_asignado_usu_id' => Yii::$app->user->id]]),
                    'sort'=> ['defaultOrder' => ['mod_post_fechamodificacion'=>SORT_DESC]], 
                    'pagination' => [
                        'pageSize' => 5,
                    ],
                ]);

                /*echo json_encode(
                        [
                            'data'=> $this->renderAjax('//post/post',['post'=>$post]),
                            'li'  => \yii\bootstrap\Html::a('',['modulo/getpost','limit'=>$limit,'offset'=>$offset+$limit])
                        ]
                        
                        
                        );*/
                return  $this->renderAjax('//post/post',['post'=>$post]);
        //exit;

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
            $post->mod_activo                 =  1;
            $post->mod_usu_id                 =  Yii::$app->user->id;
            if($post->save()){
             
                foreach ($_POST['ModuloPostHasModuloRegistro'] as $index => $reg){
                    $mod  = new \backend\models\ModuloPostHasModuloRegistro();
                    $mod->mod_post_id = $post->mod_post_id;
                    $mod->mod_reg_id  = $index;
                    $mod->contenido   = $reg;
                    $mod->insert(); 
                } 
                
                $notificacion = new \backend\models\Notificacion();
                $notificacion->not_fechacreacion     = date("Y-m-d H:i:s");
                $notificacion->not_fechamodificacion = date("Y-m-d H:i:s");
                $notificacion->not_usu_id            = Yii::$app->user->id;
                $notificacion->not_usu_id_para       = $post->mod_post_asignado_usu_id;
                $notificacion->not_titulo            = 'te ha asignado el post';
                $notificacion->not_tipo              = 1;
                $notificacion->not_post_id           = $post->mod_post_id;
                $notificacion->insert();
                
                echo json_encode([
                    'status'=>'save'
                ]);
                exit; 
            }
            
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
                    'id'=> $model->com_mod_post_id,
                    'coment'=> $this->renderAjax('//post/_comentario',['model'=>$model])
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
            
            $exist = \backend\models\ModuloPostHasUsuario::findOne([
                'modulo_post_mod_post_id'=> $model->modulo_post_mod_post_id,
                'usuario_usu_id'         => $model->usuario_usu_id]);
            
            
            
            if($exist){
                echo json_encode([
                    'status'=>'failed',
                    'msj'   => 'Usuario seleccionado ya se encuentra asignado.'
                ]);
                exit;
                
            }else{
                if($model->save()){
                    echo json_encode([
                        'status'=> 'success',
                        'id'    => $model->modulo_post_mod_post_id
                    ]);
                    exit;
                }
            }
                       
            echo json_encode([
                'status'=>'failed',
                'msj'   => 'Algo ocurrio al asignar usuario!.'
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
        }
        echo json_encode([
            'status'=>'failed',
            //'form' => $this->renderAjax('_formUpload',['model'=>$model])
            ]);
        exit;
    }
    
    public function actionUpdatefiles(){
        
        $id = Yii::$app->request->post('id');
        $dataProvider = new ActiveDataProvider([
            'query' => \backend\models\ModuloPostFiles::find()->where(['file_post_id'=>$id]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $this->renderAjax('//post/Files',['dataProvider'=>$dataProvider,'id'=>$id]);
    }
    
    public function actionUpdateusuarios(){
        
        $id = Yii::$app->request->post('id');
        
        $dataProvider = new ActiveDataProvider([
            'query' => \backend\models\ModuloPostHasUsuario::find()->where(['modulo_post_mod_post_id'=>$id]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $this->renderAjax('//post/Usuarios',['dataProvider'=>$dataProvider,'id'=>$id]);
    }
    
    public function actionUpdatepost(){
        $id      = Yii::$app->request->post('mod_post_id');
        $model   = \backend\models\ModuloPost::findOne(['mod_post_id'=>$id]);
        $modulo  = $this->findModel($model->mod_id);   
        
        if ($model->load(Yii::$app->request->post())) {
            $model->mod_post_titulo = 'Ha modificado';
            $model->mod_post_fechamodificacion = date("Y-m-d H:i:s");
            if($model->save()){
                if($_POST['ModuloPostHasModuloRegistro']){
                    foreach ($_POST['ModuloPostHasModuloRegistro'] as $index => $reg){
                        $mod  = \backend\models\ModuloPostHasModuloRegistro::findOne(['mod_post_id'=>$model->mod_post_id,'mod_reg_id'=>$index]);
                        $mod->contenido  = $reg;
                        $mod->update();
                    } 
                }
            }        
        }
        

        echo json_encode([
            'status'=>'success',
            'div'=>$this->renderAjax('updatePost',['model'=>$modulo,'post'=>$model])
        ]);
    }
}
