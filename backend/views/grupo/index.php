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

<style>
    #grupo-menu{
        margin-top: 10px;
        padding: 5px 0;
        margin-left: 20px;
    }
    #grupo-menu li{
        margin-right:15px;
    }

    #grupo-menu li,#grupo-menu li:hover,#grupo-menu li a:hover{
        background: none;
    }

    #grupo-menu li > a{
        padding: 0;
        border-bottom: 4px solid transparent;
        line-height: 25px;
    }

    #grupo-menu li.active > a,#grupo-menu li a:hover{
        border-bottom: 4px solid rgba(255,255,255,.3);
    }

</style>

<div id="group-head" class="col-md-12" style="background:#c54c45 ;min-height: 150px;margin-bottom: 20px;">
    <div class="row" style="background: #b74845;height: 40px"></div>

    <div class="row" style="padding-left:140px;position: relative">
        <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-rounded" style="position:absolute;top:-15px;left: 10px;"/>
        <div class="col-md-12" style="min-height:115px;padding-top: 10px;">
            <h2 style="display: inline;color:#fff;"><span><?= ucwords(strtolower($model->grupo_nombre)); ?></span></h2>
            <p style="color:#fff;">
                <?= $model->grupo_descripcion; ?>
            </p>
        </div>
    </div>

    <div id="group-head-menu" class="row">    
        <?php
        $menu = [];
        $menu[] = ['label' => '<i class="fa fa-navicon" ></i> Post', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/index', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-comments-o" ></i> Conversaciones', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/conversaciones', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-archive" ></i> Archivos', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/archivos', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-cog" ></i> Configuracion', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/configuracion', 'id' => $model->grupo_id]];

        echo \yii\widgets\Menu::widget([
            'options' => ['id' => 'grupo-menu', 'class' => 'nav navbar-nav navbar-left'],
            'items' => $menu,
            'encodeLabels' => false, //allows you to use html in labels
            'activateParents' => true]);
        ?>
    </div>
</div>

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







