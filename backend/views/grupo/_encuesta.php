<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>
<p><strong><?= ucwords(strtolower($model->con_contenido));?> ?</strong></p>

 <?php 
 $resp = new backend\models\EncuestaRespuestaHasUsuario();
 $form = ActiveForm::begin([
        'id'=>'form-votar'
    ]); ?>

<?php 
$options = [];
  foreach ($model->encuestaRespuestas as $respuesta):
    $options[$respuesta->id] =  $respuesta->nombre;
  endforeach;?>

    <?= $form->field($resp, 'respuesta_id')->radioList($options,
    [
        'item' => function($index, $label, $name, $checked, $value) {

            $check = ($checked)?"checked":"";   

            $return = '<div class="radio radio-info" style="margin-left:0;">';
            $return .= '<input id="publico'.$index.'" type="radio" name="' . $name . '" value="'.$value.'" '.$check.' />';
            $return .= '<label for="publico'.$index.'">' . ucwords($label) . '</label>';
            $return .= '</div>';

            return $return;
        }
    ]
    )->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Votar', ['id'=>'btn-guardar', 'class' => 'btn btn-primary']) ?>
    </div>

 <?php ActiveForm::end(); ?>
