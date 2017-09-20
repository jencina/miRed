<div class="repuesta">
   <?= $form->field($respuesta, 'nombre')->textInput(
                                    [   'id'=>"encuestarespuesta-nombre-{$i}",'name'=>"EncuestaRespuesta[{$i}][nombre]",
                                        'maxlength' => 50, 'placeholder' => 'Respuesta'])->label(false) ?> 

    <?= \yii\bootstrap\Html::hiddenInput('respuesta-count',$i,['class'=>'respuesta-count'])?> 
</div>
