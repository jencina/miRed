<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<?php 

$form = ActiveForm::begin([
    'id'=>'post-form',
     'enableClientValidation' => false,
]);

if($post->moduloPostHasModuloRegistros){
    foreach ($post->moduloPostHasModuloRegistros as $index=>$reg): 
        switch ($reg->modReg->mod_reg_tipo_id){
           case 1:
               echo $form->field($reg, 'contenido')
                   ->textInput(['name'=>"ModuloPostHasModuloRegistro[{$reg->mod_reg_id}]contenido", 'maxlenght' => true])
                           ->label($reg->modReg->mod_reg_nombre);
               break;
           case 2:
               echo $form->field($reg, 'contenido')->textInput(['maxlength' => true]);
               break;
        }   
    endforeach;
}

echo $form->field($post, 'mod_post_asignado_usu_id')
                   ->dropDownList(ArrayHelper::map(backend\models\Usuario::find()->all(), 'usu_id', 'usu_nombre'));

echo \yii\bootstrap\Html::hiddenInput('mod_id', $model->mod_id);
echo \yii\bootstrap\Html::hiddenInput('mod_post_id', $post->mod_post_id);

echo '<div class="modal-footer">';
echo Html::submitButton('Guardar', ['id'=>'btn-guardar','class'=> 'btn btn-primary']);
echo '</div>';


ActiveForm::end();
?>

<?php
//$urlNewEntidad = \yii\helpers\Json::htmlEncode(Url::to(['modulo/loadmodulo']));

$this->registerJs(<<<JS
   $('form#post-form').on('beforeSubmit',function(){
        $.ajax({
            url: $(this)[0].action,
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            error:function(){
                $("#btn-guardar").button('reset');
                $.notify({
                    title: "Nuevo Modulo",
                    text: "Hubo un error al generar Post.",
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
                    $("#modulo-modal .modulo-form").html(resp.div);
                }else{
                    $("#post-"+resp.id).remove();
                    $("#lista-post .content").prepend(resp.div);
                    $("#modulo-modal").modal("toggle");
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'save'){
                    swal({ title: "Nuevo Modulo", text: "Post generado con exito.", type: "success" });
                }
                $("#btn-guardar").button('reset');
            }
        });
        
        return false;     
   });     
JS
);
?>
