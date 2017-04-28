<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('app', 'Create Empresa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'] = 'Empresas';

?>

<div class="panel panel-border panel-purple">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $this->title ?>
        </h3>
    </div>
    <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
        'plan'  => $plan
    ]) ?>
    </div>

</div>
