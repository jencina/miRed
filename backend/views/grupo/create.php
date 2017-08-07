<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */

$this->title = 'Create Grupo';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>


<?php

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
