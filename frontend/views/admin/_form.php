<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'adm_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_status')->textInput() ?>

    <?= $form->field($model, 'adm_auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_fechacreacion')->textInput() ?>

    <?= $form->field($model, 'adm_fechamodificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
