<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .color-picker .radio span{
        display: block;
    }

    .color-picker input[type="radio"]{
        display:none;
    }
    
    .color-picker label:after {
        display:none;
    }
    .color-picker label:before {
        background-color: transparent;
        color: white;
        content: " ";
        display: block;
        border: none;
        position: absolute;
        top: 2px;
        left: 28px;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 35px;
        transition-duration: 0.4s;
        transform: scale(0);
    }
    
    .color-picker :checked + label:before {
      content: "✓";
      transform: scale(2);
    }
    
</style>

<div class="grupo-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form-grupo'
    ]); ?>

    <?= $form->field($model, 'grupo_nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'grupo_descripcion')->textarea(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'grupo_color')->radioList([
        '#91401A'=>'<span style="background-color:#91401A;width:40px;height:40px;"></span> ',
        '#915A1A'=>'<span style="background-color:#915A1A;width:40px;height:40px;"></span> ',
        '#5B7D0C'=>'<span style="background-color:#5B7D0C;width:40px;height:40px;"></span> ',
        '#348255'=>'<span style="background-color:#348255;width:40px;height:40px;"></span> ',
        '#317C8B'=>'<span style="background-color:#317C8B;width:40px;height:40px;"></span> ',
        '#1952A1'=>'<span style="background-color:#1952A1;width:40px;height:40px;"></span> ',
        '#377CA1'=>'<span style="background-color:#377CA1;width:40px;height:40px;"></span> ',
        '#4E5C6D'=>'<span style="background-color:#4E5C6D;width:40px;height:40px;"></span> ',
        '#2B3F59'=>'<span style="background-color:#2B3F59;width:40px;height:40px;"></span> ',
        '#48456E'=>'<span style="background-color:#48456E;width:40px;height:40px;"></span> ',
        '#6A588A'=>'<span style="background-color:#6A588A;width:40px;height:40px;"></span> ',
        '#B01263'=>'<span style="background-color:#B01263;width:40px;height:40px;"></span> ',
        '#913648'=>'<span style="background-color:#913648;width:40px;height:40px;"></span> ',
        '#c54c45'=>'<span style="background-color:#c54c45;width:40px;height:40px;"></span> ',
    ],['class'=>'color-picker',
        'item' => function($index, $label, $name, $checked, $value) {
                    $check = ($checked)?"checked":"";   
        
                    $return = '<div class="radio radio-info radio-inline" style="margin-left:0;">';
                    $return .= '<input id="color'.$index.'" type="radio" name="' . $name . '" value="' . $value . '" '.$check.' />';
                    $return .= '<label for="color'.$index.'">' . ucwords($label) . '</label>';
                    $return .= '</div>';

                    return $return;
                }]) ?>
    
    <?= $form->field($model, 'grup_publico')->radioList([
        0 =>'<strong>Acceso Publico :</strong> Todos los usuarios pueden ver este grupo',
        1=>'<strong>Acceso Privado :</strong> Solo los usuarios miembros pueden ver este grupo'],
            [
                'item' => function($index, $label, $name, $checked, $value) {
                    
                    $check = ($checked)?"checked":"";   
        
                    $return = '<div class="radio radio-info radio-inline" style="margin-left:0;">';
                    $return .= '<input id="publico'.$index.'" type="radio" name="' . $name . '" value="'.$value.'" '.$check.' />';
                    $return .= '<label for="publico'.$index.'">' . ucwords($label) . '</label>';
                    $return .= '</div>';

                    return $return;
                }
            ]
            ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['id'=>'btn-guardar', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
