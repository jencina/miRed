<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Registrar';
?>

<div class="text-center">
    <a href="index.html" class="logo logo-lg"><i class="md md-equalizer"></i> <span>Minton</span> </a>
</div>

<?php
    $fieldOptions = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="md md-email form-control-feedback l-h-34"></i>'
        . "<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-user txt-color-teal\"></i> Por favor ingrese email/username</b>"
        . "</div>"
    ];
    
    $fieldOptions2 = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="md md-account-circle form-control-feedback l-h-34"></i>'
        . "</div>"
    ];
    
    $fieldOptions3 = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="md md-vpn-key form-control-feedback l-h-34"></i>'
        . "</div>"
    ];
    
    $fieldOptions4 = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="fa fa-phone-square form-control-feedback l-h-34"></i>'
        . "</div>"
    ];
    
    
?>

<?php
$form = ActiveForm::begin([
        'id' => 'login-form',
         'options' => [
            'class' => 'form-horizontal m-t-20'
         ],
    
        'fieldConfig' => [
            'template' => "{label}\n{input}\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'label'],
        ],
]);

echo $form->field($model, 'nombre', $fieldOptions2)
    ->label(false)
    ->textInput(['class'=>'form-control','placeholder'=>'Nombre']); 

echo $form->field($model, 'apellido', $fieldOptions2)
    ->label(false)
    ->textInput(['class'=>'form-control','placeholder'=>'Apellido']);

echo $form->field($model, 'telefono', $fieldOptions4)
    ->label(false)
    ->textInput(['class'=>'form-control','placeholder'=>'Telefono']);

echo $form->field($model, 'email', $fieldOptions)
    ->label(false)
    ->textInput(['class'=>'form-control','placeholder'=>'Email']); 


echo $form->field($model, 'password', $fieldOptions3)
    ->label(false)
    ->passwordInput(['class'=>'form-control','placeholder'=>'Password']);  ?>

<div class="form-group">
        <div class="col-xs-12">
            <div class="checkbox checkbox-primary">
                <input id="checkbox-signup" type="checkbox" checked="checked">
                <label for="checkbox-signup">
                    I accept <a href="#">Terms and Conditions</a>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group text-right m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit">Register</button>
        </div>
    </div>

<?php 
ActiveForm::end(); 
?>

<div class="form-group m-t-30">
    <div class="col-sm-12 text-center">
        <?= Html::a('Already have account?', ['site/login']); ?>
    </div>
</div>