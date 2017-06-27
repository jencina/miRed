<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->usu_id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->usu_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->usu_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'usu_id',
            'emp_id',
            'dep_id',
            'usu_nombre',
            'usu_apellido',
            'usu_email:email',
            'usu_direccion',
            'usu_imagen',
            'usu_cargo',
            'usu_password_hash',
            'usu_password_reset_token',
            'usu_status',
            'usu_auth_key',
            'usu_fechacreacion',
            'usu_fechamodificacion',
        ],
    ]) ?>

</div>
