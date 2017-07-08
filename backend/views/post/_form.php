<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_id')->textInput() ?>

    <?= $form->field($model, 'dep_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_status')->textInput() ?>

    <?= $form->field($model, 'usu_auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_fechacreacion')->textInput() ?>

    <?= $form->field($model, 'usu_fechamodificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
