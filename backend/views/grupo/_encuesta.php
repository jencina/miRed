<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<p><strong><?= ucwords(strtolower($model->con_contenido)); ?> ?</strong></p>
<?php if ($model->tieneVoto) { ?>
    <?php 
    $count = $model->totalVotos;
    foreach ($model->encuestaRespuestas as $respuesta): ?>
        <?php 
        $votos  = count($respuesta->encuestaRespuestaHasUsuarios);
        $porcen = ($votos*100)/$count;
                
                ?>
        <div class="row">
            <div class="col-md-10">
                <div class="progress progress-lg m-b-5" style="height: auto !important;">
                    <div class="progress-bar progress-bar-info progress-animated animated" role="progressbar" aria-valuenow="<?= $porcen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $porcen;?>%;padding: 3px 0;min-height: 25px;position: relative;">
                        <span class="text-inverse" style="position: absolute;
                            width: 100%;
                            left: 0;
                            text-align: left;
                            padding-left: 10px;"><?= $respuesta->nombre;?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-inverse waves-effect waves-light" style="padding: 2px 14px;">
                    + <?= $votos ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php } else { ?>
    <?php
    $resp = new backend\models\EncuestaRespuestaHasUsuario();
    $form = ActiveForm::begin([
                'id' => 'form-votar' . $model->con_id,
                'options' => ['class' => 'votar']
    ]);
    ?>

    <?php
    $options = [];
    foreach ($model->encuestaRespuestas as $respuesta):
        $options[$respuesta->respuesta_id] = $respuesta->nombre;
    endforeach;
    ?>

    <?=
    $form->field($resp, 'respuesta_id')->radioList($options, [
        'item' => function($index, $label, $name, $checked, $value) {

            $check = ($checked) ? "checked" : "";
            $return = '<div class="radio radio-info" style="margin-left:0;">';
            $return .= '<input id="publico' . $index . '" type="radio" name="' . $name . '" value="' . $value . '" ' . $check . ' />';
            $return .= '<label for="publico' . $index . '">' . ucwords($label) . '</label>';
            $return .= '</div>';

            return $return;
        }
            ]
    )->label(false)
    ?>

    <div class="form-group">
    <?= Html::submitButton('Votar', ['id' => 'btn-guardar', 'class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<?php } ?>

        
 <?php
 $votarEncuesta        = \yii\helpers\Json::htmlEncode(Url::to(['grupo/votar-encuesta']));
$this->registerJs(<<<JS

    $(document).on("ready ajaxComplete",function(){
            
        $("form.votar").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = $(this);
            $.ajax({
                url: $votarEncuesta,
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
                    $("#post-"+resp.id+" dl.dl-horizontal").html(resp.div);

                },complete:function(jqXHR, textStatus){
                    form[0].reset();
                    form.find("button").button("reset");
                }
            });
            return false;
        });        
   
   
        });
        
JS
);
 
 
 ?>
 
