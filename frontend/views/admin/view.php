<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = $model->adm_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->adm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->adm_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'adm_id',
            'adm_nombre',
            'adm_apellido',
            'adm_telefono',
            'adm_email:email',
            'adm_password_hash',
            'adm_password_reset_token',
            'adm_status',
            'adm_auth_key',
            'adm_fechacreacion',
            'adm_fechamodificacion',
        ],
    ]) ?>

</div>
