<?php

use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['tittle'] = 'Grupo';
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('_header',['model'=>$model]);?>

<div class="row">
    
    <div class="col-md-7">

    </div>

    <div class="col-md-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">USUARIOS</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        Pjax::begin([
                            'id' => 'usuarios-emp-list',
                            'timeout' => 5500,
                            'enablePushState' => false,
                                // 'clientOptions' => ['method' => 'POST']
                        ])
                        ?>
                        <?php
                        $dataProvider = new ActiveDataProvider([
                            'query' => backend\models\Usuario::find()
                                    ->where(['emp_id' => Yii::$app->session->get('empresa')])
                                    ->andWhere(['<>', 'usu_id', Yii::$app->user->id]),
                            'pagination' => [
                                'pageSize' => 10,
                            ],
                        ]);
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'id' => 'usuarios-emp',
                            'itemOptions' => ['class' => 'item-list'],
                            'itemView' => '//usuario/_usuarios',
                            'layout' => '{items}{pager}',
                            'pager' => [
                            // 'class' => \kop\y2sp\ScrollPager::className(),
                            // 'triggerText'=>'Cargar Post'
                            ]
                        ]);
                        ?>
                        <?php Pjax::end() ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card-box">
                    <div id="calendar"></div>
                </div>
            </div> <!-- end col -->
        </div>    
    </div>
</div>







