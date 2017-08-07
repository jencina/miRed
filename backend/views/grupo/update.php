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
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>  
</div>
