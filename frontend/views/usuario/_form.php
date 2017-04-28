<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usu_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_fechacreacion')->textInput() ?>

    <?= $form->field($model, 'usu_fechamodificacion')->textInput() ?>

    <?= $form->field($model, 'usu_activo')->textInput() ?>

    <?= $form->field($model, 'emp_id')->textInput() ?>

    <?= $form->field($model, 'dep_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
