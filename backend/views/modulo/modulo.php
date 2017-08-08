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

if($modulo->moduloRegistros){
    foreach ($modulo->moduloRegistros as $index=>$reg): 
        switch ($reg->mod_reg_tipo_id){
           case 1:
               echo $form->field($model, 'contenido')
                   ->textInput(['name'=>"ModuloPostHasModuloRegistro[{$reg->mod_reg_id}]contenido",'maxlenght' => true])
                           ->label($reg->mod_reg_nombre);
               break;
           case 2:
               echo $form->field($model, 'contenido')->textInput(['maxlength' => true]);
               break;
        }   
    endforeach;
}

echo $form->field($post, 'mod_post_asignado_usu_id')
                   ->dropDownList(ArrayHelper::map(backend\models\Usuario::find()->all(), 'usu_id', 'usu_nombre'));

echo \yii\bootstrap\Html::hiddenInput('mod_id', $modulo->mod_id);

if(isset($grupo)){
    if($grupo > 0){
        $grup = new backend\models\ModuloPostHasGrupo();
        $grup->grupo_id = $grupo;
        echo $form->field($grup, 'grupo_id')->hiddenInput()->label(false);
    }
}

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
               
                console.log('error');
                
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
                   $("#modulo-modal").modal("toggle");
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'save'){
                    $('#lista-post .content').prepend(jqXHR.responseJSON.div);
                    //$.pjax.reload({container: '#post-list' , async: false});
                    swal({ title: "Nuevo Post", text: "Post generado con exito.", type: "success" });
                }
                $("#btn-guardar").button('reset');
            }
        });
        
        return false;     
   });     
JS
);
?>
