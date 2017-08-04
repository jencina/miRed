<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form-grupo'
    ]); ?>

    <?= $form->field($model, 'grupo_nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'grup_publico')->textInput() ?>

    <?= $form->field($model, 'grupo_color')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'grupo_descripcion')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['id'=>'btn-guardar', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
//$urlNewEntidad = \yii\helpers\Json::htmlEncode(Url::to(['modulo/loadmodulo']));

$this->registerJs(<<<JS
   $('form#form-grupo').on('beforeSubmit',function(){
        $.ajax({
            url: $(this)[0].action,
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            error:function(){
                $("#btn-guardar").button('reset');
                
                $.notify({
                    title: "Nuevo Grupo",
                    text: "Hubo un error al generar Grupo.",
                    image: "<i class='fa fa-exclamation'></i>"
                }, {
                    style: 'metro',
                    className: "error",
                    globalPosition:"bottom right",
                    showAnimation: "show",
                    showDuration: 0,
                    hideDuration: 0,
                    autoHide: true,
                    clickToHide: true
                });
            },
            beforeSend:function(){
                $("#btn-guardar").button('loading');
            },
            success:function(resp){
                if(resp.status == 'false'){
                    $("#grupo-modal .modulo-form").html(resp.div);
                }else{
                    $("#grupo-modal").modal("toggle");
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'save'){
                    swal({ title: "Nuevo Grupo", text: "Grupo generado con exito.", type: "success" });
                }
                $("#btn-guardar").button('reset');
            }
        });
        
        return false;     
   });     
JS
);
?>