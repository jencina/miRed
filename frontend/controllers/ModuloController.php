<?php

namespace frontend\controllers;

use Yii;
use app\models\Modulo;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class ModuloController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                       'actions' => ['create','update'],
                       'allow' => true,
                       'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    
    public function actionCreate()
    {
        if(Yii::$app->request->isAjax)
        {
           $model     = new \app\models\Modulo();
           
           $registros = array(); 
           $save      = true;
           if($model->load(Yii::$app->request->post())){
               
               $model->mod_fechacreacion     = date("Y-m-d h:i:s");
               $model->mod_fechamodificacion = date("Y-m-d h:i:s");
               $model->mod_activo            = 1;
               
               foreach (Yii::$app->request->post('ModuloRegistro') as $index => $reg){
                   $registro = new \app\models\ModuloRegistro();
                   $post['ModuloRegistro']= $reg;
                   $registro->load($post);
                   //$save  = $save && $registro->validate(); 
                   if(!$registro->validate()){
                       $save = false;
                   }
                   $registros[] = $registro;
               }

               if(!$model->validate()){
                    $save = false;
               }

               if($save){
                    if($model->save()){
                        foreach ($registros as $reg){
                            $reg->mod_reg_mod_id            = $model->mod_id;
                            $reg->mod_reg_fechacreacion     = date("Y-m-d h:i:s");
                            $reg->mod_reg_fechamodificacion = date("Y-m-d h:i:s");
                            $reg->insert();
                        }
                        
                        echo json_encode([
                            'status'=>'true'
                        ]);
                        exit;
                    }
               }
              
               echo json_encode([
                   'status'=>'false',
                   'div'=> $this->renderAjax('_formModulo',['mod'=>$model,'registros'=>$registros])
               ]);
               exit;
            }
            
            $model->emp_id = Yii::$app->request->get('emp_id');
            
            echo json_encode([
                'status'=>'success',
                'div'=> $this->renderAjax('_formModulo',['mod'=>$model,'registros'=>$registros])
            ]);
            exit;
        }  
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->request->isAjax)
        {
            $id = Yii::$app->request->get('id');
            $model = \app\models\Modulo::findOne(['mod_id'=>$id]);

            if($model->load(Yii::$app->request->post())){
                
                
            }
            
            echo json_encode([
                'status'=>'success',
                'div'=> $this->renderAjax('_formModulo',['mod'=>$model,'registros'=>$model->moduloRegistros])
            ]);
            exit;
        }
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

