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

<?= $this->render('_header',['model'=>$model]);?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-border panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Grupo Configuracion</h3>
            </div>
            <div class="panel-body">
                
                
            </div>
        </div>
    </div>  
    
    <div class="col-md-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">Autor</p>
                </div>
            </div>
        </div>
        
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">Administrador</p>
                </div>
            </div>
        </div>
    </div>
</div>
