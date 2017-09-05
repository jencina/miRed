<?php

namespace backend\controllers;

use Yii;
use backend\models\Grupo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main-admin';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                       /* 'actions' => ['conversaciones','index','getpost','create','configuracion',
                            'eventos','createconversacion','archivos','create-like','create-respuesta','delete-like'],*/
                        'roles' => ['@'],
                    ],
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
    
    public function actionGetpost(){
               
                $limit  = Yii::$app->request->get('limit');
                $offset = Yii::$app->request->get('offset'); 
                
                $id     = Yii::$app->request->get('grupo_id'); 
                
                $post = \backend\models\ModuloPost::find()
                ->join('inner join','modulo_post_has_grupo', 'modulo_post_has_grupo.mod_post_id = modulo_post.mod_post_id')
                ->where(['mod_activo'=>1,'modulo_post_has_grupo.grupo_id'=>$id])
                ->andWhere(['or',['mod_usu_id' => Yii::$app->user->id],['mod_post_asignado_usu_id' => Yii::$app->user->id]])
                ->limit($limit)  //hasta
                ->offset($offset) //desde
                ->orderBy([ 'mod_post_fechamodificacion' => SORT_DESC])
                ->all();
                
                $count = \backend\models\ModuloPost::find()
                ->where(['mod_activo'=>1])
                ->andWhere(['or',['mod_usu_id' => Yii::$app->user->id],['mod_post_asignado_usu_id' => Yii::$app->user->id]])
                ->count('*');

                return  $this->renderAjax('//post/post',['post'=>$post]);
    }

    /**
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex($id)
    {


        return $this->render('index', [
            'model' => $this->findModel($id),
        ]);
    }

    
    

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grupo();

        if ($model->load(Yii::$app->request->post())) {    
            $model->grupo_fechacreacion     = date("Y-m-d H:i:s");
            $model->grupo_fechamodificacion = date("Y-m-d H:i:s");
            $model->grupo_activo            = 1;
            $model->grupo_admin             = Yii::$app->user->id;
            $model->usu_id_create           = Yii::$app->user->id;
            $model->emp_id                  = Yii::$app->user->identity->emp_id;
            
            if($model->save()){
               echo json_encode([
                    'status'=>'save'
                ]); 
               exit;
            }
        }
        
        echo json_encode([
            'status'=>'success',
            'div'=>$this->renderAjax('create',['model'=>$model])
        ]);
        
    }

    /**
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionConfiguracion($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
               return $this->redirect(['index', 'id' => $model->grupo_id]); 
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionConversaciones($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => \backend\models\Conversacion::find()->where(['grupo_id'=>$id])->andWhere(['is', 'con_id_padre', null]),
            'sort'=> ['defaultOrder' => ['con_fechacreacion'=>SORT_DESC]], 
            'pagination' => [ 'pageSize' => 5 ],
        ]);
        
        $conversacion = new \backend\models\Conversacion();
        $conversacion->grupo_id = $id;
        
        $encuesta = new \backend\models\Conversacion();
        $encuesta->grupo_id = $id;
        
        return $this->render('conversaciones', [
            'model'        => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'conversacion' => $conversacion,
            'encuesta'     => $encuesta
        ]);
    }
    
    public function actionCreateconversacion(){
        
        $model = new \backend\models\Conversacion();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->con_fechacreacion      =  date("Y-m-d H:i:s");
            $model->con_fechamodificacion  =  date("Y-m-d H:i:s");
            $model->usu_id                 = Yii::$app->user->id;
            $model->tipo_id                = 1;
            
            if($model->save()){
                echo json_encode([
                    'status'=>'save',
                ]);
                exit;
            }
        }
        
        echo json_encode([
            'status'=>'failed',
            //'form' => $this->renderAjax('_formUpload',['model'=>$model])
            ]);
        exit;
    }
    
    public function actionCreateEncuesta(){
        
        $model = new \backend\models\Conversacion();
        
        if ($model->load(Yii::$app->request->post())) {            
            $model->con_fechacreacion      = date("Y-m-d H:i:s");
            $model->con_fechamodificacion  = date("Y-m-d H:i:s");
            $model->usu_id                 = Yii::$app->user->id;
            $model->tipo_id                = 2;
            
            if($model->save()){
                if(isset($_POST['EncuestaRespuesta'])){
                    foreach ($_POST['EncuestaRespuesta']['nombre'] as $index => $nombre){
                        $respuesta = new \backend\models\EncuestaRespuesta();
                        $respuesta->nombre = $nombre;
                        $respuesta->con_id = $model->con_id;
                        $respuesta->fechacreacion = date("Y-m-d H:i:s");
                        $respuesta->insert();
                    }
                }
                
                echo json_encode([
                    'status'=>'save',
                ]);
                exit;
            }
        }
        
        echo json_encode([
            'status'=>'failed',
            //'form' => $this->renderAjax('_formUpload',['model'=>$model])
            ]);
        exit;
    }
    
    public function actionVotarEncuesta(){
        
        $model = new \backend\models\EncuestaRespuestaHasUsuario();
        if ($model->load(Yii::$app->request->post())) {      
            
            $model->usu_id        = Yii::$app->user->id;
            $model->fechacreacion = date("Y-m-d H:i:s");
            $model->validate();
            
            if($model->save()){
                $conversacion = \backend\models\Conversacion::findOne(['con_id'=>$model->respuesta->con_id]);
                echo json_encode([
                    'id'  => $conversacion->con_id,
                    'div' => $this->renderAjax('_encuesta',['model'=>$conversacion])
                ]);
            }   
        }
    }
    
    public function actionArchivos($id)
    {        
        $dataProvider = new ActiveDataProvider([
            'query' => \backend\models\GrupoFile::find(),
            'pagination' => [ 'pageSize' => 10 ],
        ]);

        return $this->render('archivos', [
            'model'        => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);

    }
    
    public function actionUploadfiles(){
        
        $model = new \backend\models\UploadForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            
            if ($model->upload()) {
                
                $file = new \backend\models\GrupoFile();
                $file->grupo_id               =  $model->parent_id;
                $file->file_nombre            =  $model->imageFiles[0]->name;
                $file->file_fechacreacion     =  date("Y-m-d H:i:s");
                $file->file_fechamodificacion =  date("Y-m-d H:i:s");
                $file->usu_id                 =  Yii::$app->user->id;
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
    
    
    
    public function actionEventos($id)
    {
        $model = $this->findModel($id);

        return $this->render('eventos', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Grupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCreateLike(){
        
        $id = Yii::$app->request->post('id');
        $like = new \backend\models\Like();
        $like->con_id = $id;
        $like->usu_id = Yii::$app->user->id;
        $like->fechacreacion = date("Y-m-d H:i:s");
        
        if($like->insert()){
            $model = \backend\models\Conversacion::findOne(['con_id'=>$id]);
            echo json_encode([
                'status'=>'success',
                'id' =>$id,
                'data'=>$this->renderAjax('_like',['model'=>$model])
            ]);
            exit;
        }else{
            echo json_encode([
                'status'=>'failed',
                'id' =>$id
            ]);
        }
    }
    
    public function actionDeleteLike(){
        
        $id = Yii::$app->request->post('id');
        $like = \backend\models\Like::findOne(['con_id'=>$id,'usu_id'=>Yii::$app->user->id]);
        
        if($like->delete()){
            $model = \backend\models\Conversacion::findOne(['con_id'=>$id]);
            echo json_encode([
                'status'=>'success',
                'id' =>$id,
                'data'=>$this->renderAjax('_like',['model'=>$model])
            ]);
            exit;
        }else{
            echo json_encode([
                'status'=>'failed',
                'id' =>$id
            ]);
        }
    }
    
    public function actionCreateRespuesta(){
        
        $model = new \backend\models\Conversacion();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->con_fechacreacion     =  date("Y-m-d H:i:s");
            $model->con_fechamodificacion =  date("Y-m-d H:i:s");
            $model->usu_id                 =  Yii::$app->user->id;
            
            if($model->save()){
                echo json_encode([
                    'status'=> 'save',
                    'id'    => $model->con_id_padre,
                    'div'   => $this->renderAjax('_respuesta',['model'=>$model])
                ]);
                exit;
            }
        }
        
        echo json_encode([
            'status'=>'failed',
            //'form' => $this->renderAjax('_formUpload',['model'=>$model])
            ]);
        exit;
    }
    
    public function actionMasRespuestas(){
        
        $id    = Yii::$app->request->post('id');
        $count = Yii::$app->request->post('count');
        
        $comentarios = \backend\models\Conversacion::findBySql('select t.* from (
                            SELECT * FROM conversacion where con_id_padre = '.$id.'
                            order by con_fechacreacion desc limit '.$count.',5) t order by t.con_fechacreacion asc')->all();
        
        $respuestas = '';
        foreach ($comentarios as $com){
            $respuestas .= $this->renderPartial('_respuesta',['model'=>$com]);
        }
        
        if(count($comentarios) > 0){
            echo json_encode([
                'status'=>'success',
                'id' =>$id,
                'data'=> $respuestas
            ]);
            exit;
        }else{
            echo json_encode([
                'status'=>'failed',
                'id' =>$id
            ]);
        }
    }
    
}
