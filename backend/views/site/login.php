<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
?>


<?php
    $fieldOptions = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="md md-account-circle form-control-feedback l-h-34"></i>'
        . "<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-user txt-color-teal\"></i> Por favor ingrese email/username</b>"
        . "</div>"
    ];
    
    $fieldOptions2 = [
        'options' => ['class' => 'form-group'],
        'inputTemplate' => ""
        . '<div class="col-xs-12">'
        . "{input}"
        . '<i class="md md-vpn-key form-control-feedback l-h-34"></i>'
        . "</div>"
    ];
?>

<div class="text-center">
    <?= yii\bootstrap\Html::a('<i class="fa fa-group"></i> <span>MI RED</span>',['site/login'],['class'=>'logo logo-lg']);?>
</div>


<?php
$form = ActiveForm::begin([
        'id' => 'login-form',
        //'layout' => 'horizontal',
         'options' => [
            'class' => 'form-horizontal m-t-20'
         ],
    
        'fieldConfig' => [
            'template' => "{label}\n{input}\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'label'],
        ],
]);
echo $form->field($model, 'username', $fieldOptions)
    ->label(false)
    ->textInput(['class'=>'form-control','placeholder'=>'Username']); 
echo $form
    ->field($model, 'password', $fieldOptions2)
    ->label(false)
    ->passwordInput(['class'=>'form-control','placeholder'=>'Password']);
echo $form->field($model, 'rememberMe')->checkbox();
echo '<div class="form-group text-right m-t-20">';
echo '<div class="col-xs-12">';
echo Html::submitButton('Log In', ['class' => 'btn btn-primary btn-custom w-md waves-effect waves-light', 'name' => 'login-button']);
echo '</div>';  
echo '</div>';  
echo '<div class="form-group m-t-30">';
echo '<div class="col-sm-7">';
echo Html::a('Olvidate tu contraseña?', ['site/request-password-reset'],['class'=>'text-muted']);
echo '</div>';
echo '</div>';
ActiveForm::end(); 
?>


