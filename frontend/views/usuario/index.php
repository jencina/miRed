<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usu_id',
            'usu_nombre',
            'usu_apellido',
            'usu_email:email',
            'usu_direccion',
            // 'usu_imagen',
            // 'usu_cargo',
            // 'usu_username',
            // 'usu_password',
            // 'usu_fechacreacion',
            // 'usu_fechamodificacion',
            // 'usu_activo',
            // 'emp_id',
            // 'dep_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
