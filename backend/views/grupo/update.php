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
        <div class="panel panel-border panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Grupo Configuracion</h3>
            </div>
            <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>  
    
    <div class="col-md-4">
        
        <div class="panel panel-border panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Autor Grupo</h3>
            </div>
            <div class="panel-body text-center">
                <div class="member-card">
                    <div class="thumb-xl member-thumb m-b-10 center-block">
                        <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                    </div>

                    <div class="">
                        <?php $autor = $model->usuIdCreate;?>
                        <h4 class="m-b-5"><?= ucwords(strtolower($autor->usu_nombre.' '.$autor->usu_apellido)); ?></h4>
                        <p class="text-muted"><?= $autor->usu_email; ?></p>
                        <p><?= yii\bootstrap\Html::a('Cambiar',false,['class'=>'btn btn-primary']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-border panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Administrador</h3>
            </div>
            <div class="panel-body text-center">
                <div class="member-card">
                    <div class="thumb-xl member-thumb m-b-10 center-block">
                        <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                    </div>

                    <div class="">
                        <?php $admin = $model->grupoAdmin;?>
                        <h4 class="m-b-5"><?= ucwords(strtolower($admin->usu_nombre.' '.$admin->usu_apellido)); ?></h4>
                        <p class="text-muted"><?= $admin->usu_email; ?></p>
                        <p><?= yii\bootstrap\Html::a('Cambiar',false,['class'=>'btn btn-primary']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
