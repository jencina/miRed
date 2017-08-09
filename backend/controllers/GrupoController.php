<?php

namespace backend\controllers;

use Yii;
use backend\models\Grupo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = $this->findModel($id);


        return $this->render('conversaciones', [
            'model' => $model,
        ]);

    }
    
    public function actionArchivos($id)
    {        
        $dataProvider = new ActiveDataProvider([
            'query' => \app\models\GrupoFile::find(),
        ]);

        return $this->render('archivos', [
            'model'        => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);

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
}
