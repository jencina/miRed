<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'] = 'Empresa';
?>

<div class="row">

    <div class="col-lg-3 col-md-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">@webdesigner</p>
                </div>

                <?= Html::a('Editar', ['update', 'id' => $model->emp_id], ['class' => 'btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->emp_id], ['class' => 'btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light']) ?>

                <div class="text-left m-t-40">
                    <p class="text-muted font-13"><strong>Nombre :</strong> <span class="m-l-15"><?= $model->emp_nombre ?></span></p>
                    <p class="text-muted font-13"><strong>Direccion :</strong><span class="m-l-15"><?= $model->emp_direccion; ?></span></p>
                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>
                    <p class="text-muted font-13"><strong>Region :</strong> <span class="m-l-15">USA</span></p>
                    <p class="text-muted font-13"><strong>Ciudad :</strong> <span class="m-l-15">USA</span></p>
                    <p class="text-muted font-13"><strong>Fecha Creacion :</strong> <span class="m-l-15"><?= $model->emp_fechacreacion; ?></span></p>
                </div>

                <ul class="social-links list-inline m-t-30">
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                    </li>
                </ul>
            </div>
        </div> <!-- end card-box -->

        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">PLAN <small><?= $plan->plan_nombre ?></small></h4>
            <div class="p-b-10">
                <p>Usuarios <small></small></p>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $usuarios->getCount(); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($usuarios->getCount() * 100) / $plan->plan_usuarios) ?>%">
                    </div>
                </div>
                <p>Modulos <small></small></p>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $modulos->getCount(); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($modulos->getCount() * 100) / $plan->plan_usuarios) ?>%">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-md-8 col-lg-9">       
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                    <li class="active">
                        <a href="#usuarios" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">USUARIOS</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#departamentos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-photo"></i></span>
                            <span class="hidden-xs">DEPARTAMENTOS</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#modulos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-photo"></i></span>
                            <span class="hidden-xs">MODULOS</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="usuarios">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Usuarios Empresa</h1>
                            </div>
                            <div class="pull-right">
                                <?= yii\bootstrap\Html::a('Nuevo',"#custom-modal",['id'=>'usuario','data-overlaySpeed'=>"100", 'data-overlayColor'=>"#36404a",'data-plugin'=>"custommodal",'data-animation'=>'fadein', 'class'=>'btn btn-primary waves-effect waves-light']);?>
                            </div>
                        </div>
                        <hr>
                        <?php
                        echo ListView::widget( [
                            'dataProvider' => $usuarios,
                            'itemView' => '_usuarios',
                        ] ); ?>
                    </div>
                    
                    <div class="tab-pane" id="departamentos">
                        <div class="row">

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Departamentos Empresa</h1>
                                </div>
                                <div class="pull-right">
                                    <?= yii\bootstrap\Html::a('Nuevo', "#departamento-modal", ['id' => 'usuario', 'data-overlaySpeed' => "100", 'data-overlayColor' => "#36404a", 'data-plugin' => "custommodal", 'data-animation' => 'fadein', 'class' => 'btn btn-primary waves-effect waves-light']); ?>
                                </div>
                            </div>
                            <hr>
                            <?php Pjax::begin(['id' => 'departamentos-list']) ?>
                            <?php
                            echo ListView::widget([
                                'dataProvider' => $departamentos,
                                'itemView' => '_departamentos',
                            ]);
                            ?>
                            <?php Pjax::end() ?>

                        </div>
                    </div>
                    
                    <div class="tab-pane" id="modulos">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Modulos Empresa</h1>
                            </div>
                            <div class="pull-right">
                                <?= yii\bootstrap\Html::a('Nuevo',"#modulo-modal",['id'=>'usuario','data-overlaySpeed'=>"100", 'data-overlayColor'=>"#36404a",'data-plugin'=>"custommodal",'data-animation'=>'fadein', 'class'=>'btn btn-primary waves-effect waves-light']);?>
                            </div>
                        </div>
                        <hr>
                        <?php
                        echo ListView::widget( [
                            'dataProvider' => $modulos,
                            'itemView' => '_modulos',
                        ] ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Usuario Nuevo</h4>
    
    <div class="custom-modal-text">
        <?php 
        $user = new \app\models\Usuario();
        $form = ActiveForm::begin(['id'=>'user-form','layout' => 'horizontal',
            'enableClientValidation'=>false]); ?>

        <?= $form->field($user, 'usu_nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_apellido')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'usu_cargo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($user, 'dep_id')->textInput(['maxlength' => true]) ?>

    <div class="modal-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- Custom Modal -->
<div id="departamento-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title badge-info">Departamento Nuevo</h4>
    
    <div class="custom-modal-text">
        <?php 
        $dep = new \app\models\Departamento();
        $dep->emp_id = $model->emp_id;
        
        echo $this->render('_formDepartamento',['dep'=>$dep]);
        ?>
    </div>
</div>


<?php

$this->registerJsFile(Yii::getAlias('@web').'/plugins/custombox/dist/custombox.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web').'/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);

?>




