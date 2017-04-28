<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJsFile(Yii::getAlias('@web').'/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs(<<<JS
       $(document).ready(function() {
                $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});  
        });
JS
);
    
    ?>

 <?php $form = ActiveForm::begin(); ?>
<div id="basicwizard" class=" pull-in">
    <ul>
        <li><a href="#tab1" data-toggle="tab">Empresa</a></li>
        <li><a href="#tab2" data-toggle="tab">Tipo Cuenta</a></li>
        <li><a href="#tab3" data-toggle="tab">Finalizar</a></li>
    </ul>

    <div class="tab-content bx-s-0 m-b-0">
        <div class="tab-pane m-t-10 fade" id="tab1">
            <?= $form->field($model, 'emp_nombre')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'emp_direccion')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="tab-pane m-t-10 fade" id="tab2">
            <div class="col-md-12">
            <?php foreach($plan as $p){ ?>
            <article class="pricing-column col-lg-4 col-md-4">
                <?php if($p->plan_destacado == 1):?>
                <div class="ribbon"><span>POPULAR</span></div>
                <?php endif;?>
                <div class="inner-box card-box">
                    <div class="plan-header text-center">
                        <h3 class="plan-title">Plan <?= $p->plan_nombre?></h3>
                        <h2 class="plan-price">$<?= $p->plan_precio?></h2>
                        <div class="plan-duration"><?= $p->plan_periodo?></div>
                    </div>
                    <ul class="plan-stats list-unstyled text-center">
                        <li><i class="ti-briefcase text-success"></i> <?= $p->plan_modulos;?> Modulos</li>
                        <li><i class="ti-user text-success"></i> <?= $p->plan_usuarios;?> User</li>
                        <li><i class="ti-headphone-alt text-success"></i> 24x7 Soporte</li>
                    </ul>

                    <div class="text-center">
                        <a href="#" class="btn btn-danger btn-bordred btn-rounded waves-effect waves-light">Signup Now</a>
                    </div>
                </div>
                
                <div class="radio radio-success text-center">
                    <input type="radio" name="Empresa[plan_id]" id="radio4" value="<?= $p->plan_id?>" <?= ($model->plan_id == $p->plan_id)?"checked":""?> >
                    <label for="radio4">
                        Plan <?= $p->plan_nombre?>
                    </label>
                </div>
                
            </article>
                
            <?php } ?>
            </div>
        </div>
        
        <div class="tab-pane m-t-10 fade" id="tab3">
            <button type="submit" class="btn btn-block btn--md btn-success waves-effect waves-light">Guardar</button>
        </div>
        
        <ul class="pager wizard m-b-0">
            <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Previous</a></li>
            <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Next</a></li>
        </ul>
    </div>
</div>   

<?php ActiveForm::end(); ?>
