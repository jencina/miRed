<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */

$this->title = 'Update Grupo: ' . $model->grupo_id;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucwords(strtolower($model->grupo_nombre))), 'url' => ['view', 'id' => $model->grupo_id]];
$this->params['breadcrumbs'][] = 'Configuracion';
$this->params['tittle'] = 'Grupo';
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

<div class="grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
