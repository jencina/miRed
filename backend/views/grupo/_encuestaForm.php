<?php 

    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    
    $respuesta = new \backend\models\EncuestaRespuesta();
    $encuesta->scenario = 'encuesta-create';
    $form = ActiveForm::begin(['id' => 'form-encuesta','enableClientValidation'=>false]); ?>

    <div class="panel-body">               
        <?= $form->field($encuesta, 'con_contenido', ['options' => ['class' => '']])->textInput(['maxlength' => 50, 'placeholder' => 'Pregunta?'])->label(false) ?>                
        <?= $form->field($encuesta, 'grupo_id')->hiddenInput()->label(false) ?> 
        <?php $i = 0;?>

        <div class="respuesta-content">
            <?php   
                if(isset($respuestas)){
                    foreach ($respuestas as $i=>$resp){
                        echo $this->render('_respuestaInput', ['respuesta'=>$resp,'form'=>$form,'i'=>$i]);
                    }
                }else{
                    echo $this->render('_respuestaInput', ['respuesta'=>$respuesta,'form'=>$form,'i'=>$i]);
                }
            ?>
        </div>
        <button id="add-respuesta" type="button" class="btn btn-block btn--md btn-pink waves-effect waves-light"><i class="fa fa-plus"></i> Respuesta</button>
    </div>

    <div class="panel-footer">
        <?= Html::submitButton('Publicar', ['id' => 'btn-guardar', 'class' => $encuesta->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>   


<?php
$createEncuesta       = \yii\helpers\Json::htmlEncode(Url::to(['grupo/create-encuesta']));
$this->registerJs(<<<JS
           
    $(document).on("ajaxComplete ready",function(){ 
        $("#form-encuesta").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();

            console.log('asd');

            var form = $(this);
            $.ajax({
                url: $createEncuesta,
                type:'post',
                dataType:'json',
                data: form.serialize(),
                error:function(){
                    form.find("button").button("reset");
                },
                beforeSend:function(){
                   form.find("button").button("loading");
                },
                success:function(resp){
                    if(resp.status == "failed"){
                        $("#profile-12").html(resp.form);
                    }else{
                        $("#profile-12").html(resp.form);
                        $.pjax.reload({container:"#list-conversaciones"}); 
                    }
                },complete:function(jqXHR, textStatus){

                    form.find("button").button("reset");
                }
            });
            return false;
        });  
   });

JS
);

?>