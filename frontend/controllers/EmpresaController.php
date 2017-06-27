<?php

namespace frontend\controllers;

use Yii;
use app\models\Empresa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main-admin';
    
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

    /**
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Empresa::find()->where(['adm_id'=>Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empresa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model    = $this->findModel($id);
        $usuarios = new ActiveDataProvider([
            'query' => \app\models\Usuario::find()->where(['emp_id'=>$id]),
        ]);
        
        $modulos = new ActiveDataProvider([
            'query' => \app\models\Modulo::find()->where(['emp_id'=>$id,'mod_activo'=>1]),
        ]);
        
        $departamentos = new ActiveDataProvider([
            'query' => \app\models\Departamento::find()->where(['emp_id'=>$id]),
        ]);
        
        $plan    = $model->getPlan()->one();
               
        return $this->render('view', [
            'model'     => $model,
            'usuarios'  => $usuarios,
            'modulos'   => $modulos,
            'departamentos'=>$departamentos,
            'plan'      => $plan
        ]);
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();
        $plan  = \app\models\Plan::find()->where(['plan_status'=>1])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->emp_fechacreacion     = date("Y-m-d h:i:s");
            $model->emp_fechamodificacion = date("Y-m-d h:i:s");
            $model->emp_activo            = 0;
            $model->adm_id                = Yii::$app->user->id;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->emp_id]);
            }   
        } 
        
        return $this->render('create', [
            'model' => $model,
            'plan'  => $plan
        ]);
        
    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emp_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCreatedepartamento() {
        if(Yii::$app->request->isAjax)
        {
           $model = new \app\models\Departamento();
           if($model->load(Yii::$app->request->post())){
               $model->dep_fechacreacion     = date("Y-m-d h:i:s");
               $model->dep_fechamodificacion = date("Y-m-d h:i:s");
               if($model->save()){
                    echo json_encode([
                        'status'=>'true'
                    ]);
                    exit;
               }
               echo json_encode([
                   'status'=>'false',
                   'div'=> $this->renderAjax('_formDepartamento',['dep'=>$model])
               ]);
               exit;
            }
        }  
    }
    
     public function actionCreateusuario() {
        if(Yii::$app->request->isAjax)
        {
           $model = new \app\models\Usuario();
           if($model->load(Yii::$app->request->post())){
               $model->usu_fechacreacion     = date("Y-m-d h:i:s");
               $model->usu_fechamodificacion = date("Y-m-d h:i:s");
               $model->usu_status            = 0;
               $model->usu_password_hash     = Yii::$app->security->generatePasswordHash($model->usu_password_hash);
               $model->usu_auth_key          = Yii::$app->security->generateRandomString();
               
               if($model->save()){
                    echo json_encode([
                        'status'=>'true'
                    ]);
                    exit;
               }
               
               echo json_encode([
                   'status'=>'false',
                   'div'=> $this->renderAjax('_formUsuario',['user'=>$model])
               ]);
               exit;
           }
        }  
    }
    
    public function actionAddreg(){
        if(Yii::$app->request->isAjax)
        {
            $i = Yii::$app->request->post('i');
            $reg = new \app\models\ModuloRegistro();
            $form = new \yii\bootstrap\ActiveForm();
            
            $i++;
            echo json_encode([
                'status'=>'success',
                'div' => $this->renderAjax('_formModuloRegistro', ['reg'=>$reg,'i'=>$i,'form'=>$form])
            ]);
        }
    }
    
    public function actionCreatemodulo() {
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
        }  
    }
    
    public function actionDeletemodulo(){
        if(Yii::$app->request->isAjax)
        {
            $id = Yii::$app->request->post('id');
            $modulo = \app\models\Modulo::findOne(['mod_id'=>$id]);
            $modulo->mod_activo = 0;
            $modulo->update();
             echo json_encode([
                   'status'=>'success'
            ]);
            exit;
            
        }
    }
    
    public function actionUpdatemodulo(){
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
}
