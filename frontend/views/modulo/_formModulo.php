<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<?php
$form = ActiveForm::begin([
            'id' => 'modulo-form',
            'enableClientValidation' => false,
            //'options' => ['data-pjax' => true]
    ]);
?>

<div class="modal-body p-0">
    
    <ul class="nav nav-tabs navtab-custom nav-justified">
        <li class="active tab">
            <a href="#modulo-12" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">Modulo</span>
            </a>
        </li>
        <li class="tab">
            <a href="#registro-12" data-toggle="tab" aria-expanded="true">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">Registros</span>
            </a>
        </li>
    </ul>
    
    <div class="tab-content m-0">
        <div class="tab-pane active" id="modulo-12">
            <p>
                <?= $form->field($mod, 'mod_nombre')->textInput(['maxlength' => true]) ?>
                <?= $form->field($mod, 'mod_descripcion')->textarea(['maxlength' => true]) ?>
                <?= $form->field($mod, 'emp_id')->hiddenInput()->label(false); ?> 
            </p>
        </div>
        <div class="tab-pane" id="registro-12"> 
            <p><?= Html::a('agregar',null,['id'=>'add-reg','class'=>'btn btn-primary','data-loading-text'=>'Cargando...']);?></p>
            <div id="registros" class="row">
                <?php 
                foreach ($registros as $index=>$reg){
                    echo $this->render('_formModuloRegistro', ['reg'=>$reg,'i'=>$index,'form'=>$form]);
                }
                ?>
            </div>
        </div>
    </div>
</div> 



<div class="modal-footer">
<?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
$urlAddReg = \yii\helpers\Json::htmlEncode(Url::to(['empresa/addreg']));
$this->registerJs(<<<JS
    $('#add-reg').on('click',function(){
        
        var i = $('#registros > div.reg').last().attr('data-posicion');

        $.ajax({
            url: $urlAddReg,
            type:'post',
            dataType:'json',
            data:{i:i},
            beforeSend:function(){
                $('#add-reg').button('loading');
            },
            success:function(resp){
                $("#registros").append(resp.div);
            },complete:function(jqXHR, textStatus){
                $('#add-reg').button('reset');
            }
        });
        return false;     
    });      
JS
);

$urlNewEntidad = \yii\helpers\Json::htmlEncode(Url::to(['empresa/createmodulo']));
$this->registerJs(<<<JS
   $('form#modulo-form').on('beforeSubmit',function(){
        $.ajax({
            url: $(this)[0].action,
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){
                
            },
            success:function(resp){
                if(resp.status == 'false'){
                    $("#modulo-modal .modulo-form").html(resp.div);
                }else{
                    Custombox.close();
                }
            },complete:function(jqXHR, textStatus){
                if(jqXHR.responseJSON.status == 'true'){
        
                    $.pjax.reload({container: '#modulo-count', async: false});
                    $.pjax.reload({container: '#modulo-list' , async: false});
                    swal({ title: "Nuevo Modulo", text: "Modulo generado con exito.", type: "success" });
                }
            }
        });
        
        return false;     
   });     
JS
);
?>
