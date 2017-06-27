<?php 
use yii\bootstrap\ActiveForm; 
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

 <?php $form = ActiveForm::begin([
            'id'=>'user-form',
            'layout' => 'horizontal',
            'enableClientValidation'=>false,
            'options' => ['data-pjax' => true ]]); ?>

        <?= $form->field($user, 'usu_nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_apellido')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_password_hash')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'dep_id')->dropDownList(ArrayHelper::map(app\models\Departamento::find()->all(), 'dep_id', 'dep_nombre')) ?>
        <?= $form->field($user, 'emp_id')->hiddenInput()->label(false); ?>
    <div class="modal-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>


<?php
$urlNewEntidad  = \yii\helpers\Json::htmlEncode(Url::to(['empresa/createusuario']));
$this->registerJs(<<<JS
   $('form#user-form').on('beforeSubmit',function(){
        $.ajax({
            url: $urlNewEntidad,
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){
                
            },
            success:function(resp){
                if(resp.status == 'false'){
                    $("#usuario-modal .custom-modal-text").html(resp.div);
                }else{
                    Custombox.close();
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'true'){
        
                    $.pjax.reload({container: '#usuario-count', async: false});
                    $.pjax.reload({container: '#usuario-list', async: false});
                    swal({ title: "Nuevo Usuario", text: "Usuario generado con exito.", type: "success" });
                }
            }
        });
        
        return false;     
   });     
JS
   );

?>
