<?php 
use yii\bootstrap\ActiveForm; 
use yii\bootstrap\Html;
use yii\helpers\Url;
?>
<?php $form_dep = ActiveForm::begin([
            'id'=>'dep-form',
            'layout' => 'horizontal',
            'enableClientValidation'=>false,
            'options' => ['data-pjax' => true ]
            ]); ?>

        <?= $form_dep->field($dep, 'dep_nombre')->textInput(['maxlength' => true]) ?>
        <?= $form_dep->field($dep, 'emp_id')->hiddenInput()->label(false); ?>

    <div class="modal-footer">
        <?= Html::submitButton('Guardar', ['class' =>'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>


<?php
$urlNewEntidad  = \yii\helpers\Json::htmlEncode(Url::to(['empresa/createdepartamento']));
$this->registerJs(<<<JS
   $('form#dep-form').on('beforeSubmit',function(){
        $.ajax({
            url: $urlNewEntidad,
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){
                
            },
            success:function(resp){
                if(resp.status == 'false'){
                    $("#departamento-modal .custom-modal-text").html(resp.div);
                }else{
                    Custombox.close();
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'true'){
                    $.pjax.reload({container: '#departamentos-list', async: false});
                    swal({ title: "Nuevo Departamento", text: "Departamento generado con exito.", type: "success" });
                }
            }
        });
        
        return false;     
   });     
JS
   );

?>
