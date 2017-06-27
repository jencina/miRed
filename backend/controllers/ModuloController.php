<?php

namespace backend\controllers;

use Yii;
use backend\models\Modulo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
}
