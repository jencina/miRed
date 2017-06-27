<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;

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
                <?php Pjax::begin(['id' => 'usuario-count']) ?>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $usuarios->getCount(); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($usuarios->getCount() * 100) / $plan->plan_usuarios) ?>%">
                    </div>
                </div>
                <?php Pjax::end(); ?>

                <p>Modulos <small></small></p>
                <?php Pjax::begin(['id' => 'modulo-count']) ?>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $modulos->getCount(); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($modulos->getCount() * 100) / $plan->plan_usuarios) ?>%">
                    </div>
                </div>
                <?php Pjax::end(); ?>
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
                        <div class="row">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Usuarios Empresa</h1>
                                </div>
                                <div class="pull-right">
                                    <?= yii\bootstrap\Html::a('Nuevo', "#usuario-modal", ['id' => 'usuario', 'data-overlaySpeed' => "100", 'data-overlayColor' => "#36404a", 'data-plugin' => "custommodal", 'data-animation' => 'fadein', 'class' => 'btn btn-primary waves-effect waves-light']); ?>
                                </div>
                            </div>
                            <hr>
                            <?php Pjax::begin(['id' => 'usuario-list']) ?>
                            <?php
                            echo ListView::widget([
                                'dataProvider' => $usuarios,
                                'itemView' => '_usuarios',
                            ]);
                            ?>
<?php Pjax::end() ?>
                        </div>
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
                        <div class="row">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Modulos Empresa</h1>
                                </div>
                                <div class="pull-right">
                                <?= yii\bootstrap\Html::a('Nuevos',false, ['id' => 'modulo-create','class' => 'btn btn-primary waves-effect waves-light']); ?>
                                </div>
                            </div>
                            <hr>
                            <?php Pjax::begin(['id' => 'modulo-list']) ?>
                            <?php
                            echo ListView::widget([
                                'dataProvider' => $modulos,
                                'itemView' => '_modulos',
                            ]);
                            ?>
                            <?php Pjax::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Usuario Modal -->
<div id="usuario-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Usuario Nuevo</h4>

    <div class="custom-modal-text">
        <?php
        $user = new \app\models\Usuario();
        $user->emp_id = $model->emp_id;

        echo $this->render('_formUsuario', ['user' => $user]);
        ?>

    </div>
</div>

<!-- Usuario Modal -->
<div id="modulo-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title badge-info" >Modulo Nuevo</h4>
    <div class="custom-modal-text">
        <div class="modulo-form">
            <?php
           /* $mod = new \app\models\Modulo();
            $mod->emp_id = $model->emp_id;
            $registros = array();
            $reg = new \app\models\ModuloRegistro();
            $registros[] = $reg;
            echo $this->render('_formModulo', ['mod' => $mod,'registros'=>$registros]);*/
            ?>
        </div>
    </div>

</div>

<!-- Departamento Modal -->
<div id="departamento-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title badge-info">Departamento Nuevo</h4>

    <div class="custom-modal-text">
        <?php
        $dep = new \app\models\Departamento();
        $dep->emp_id = $model->emp_id;

        echo $this->render('_formDepartamento', ['dep' => $dep]);
        ?>
    </div>
</div>


<?php
$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<?php
$urlDeleteModulo  = \yii\helpers\Json::htmlEncode(Url::to(['empresa/deletemodulo']));
$urlUpdateModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/update']));
$urlNewModulo    = \yii\helpers\Json::htmlEncode(Url::to(['modulo/create']));
$this->registerJs(<<<JS
    $("#modulos").on("click","a#modulo-create",function(e){
        
        console.log('entro');
        $.ajax({
            url: $urlNewModulo,
            type:'get',
            dataType:'json',
            data: {emp_id:$model->emp_id},
            beforeSend:function(){
                $("#modulo-modal .modulo-form").html("");                
                Custombox.open({
                    target: "#modulo-modal",
                    effect: "fadein",
                    overlaySpeed: "100",
                    overlayColor: "#36404a"
                });
                $("#modulo-modal .modulo-form").before('<div id="loading">Cargando...</div>');
            },
            success:function(resp){
                $("#modulo-modal .modulo-form").html(resp.div);
            },complete:function(jqXHR, textStatus){
                $("#loading").remove();
            }
        });
        return false;
    });

    $("#modulo-list").on("click","a.modulo-eliminar",function(e){
        var id= $(this).attr("data-id");    
        $.ajax({
            url: $urlDeleteModulo,
            type:'post',
            dataType:'json',
            data:{id:id},
            beforeSend:function(){

            },
            success:function(resp){
        
            },complete:function(jqXHR, textStatus){
               if(jqXHR.responseJSON.status == 'success'){
                   $.pjax.reload({container: '#modulo-count', async: false});
                   $.pjax.reload({container: '#modulo-list', async: false});
                   swal({ title: "Modulo", text: "modulo eliminado con exito.", type: "success" });
               }
            }
        });
        return false;
    });
        
    $("#modulo-list").on("click","a.modulo-editar",function(e){
        var id= $(this).attr("data-id");    
        $.ajax({
            url: $urlUpdateModulo,
            type:'get',
            dataType:'json',
            data:{id:id},
            error:function(){
                $("#modulo-modal .modulo-form").html('<div class="alert alert-danger"><strong>Error!</strong> Algo ocurrio al cargar el formulario.</div>');
            },
            beforeSend:function(){
                $("#modulo-modal .modulo-form").html("");
                
                Custombox.open({
                    target: "#modulo-modal",
                    effect: "fadein",
                    overlaySpeed: "100",
                    overlayColor: "#36404a"
                });
                $("#modulo-modal .modulo-form").before('<div id="loading">Cargando...</div>');
                
            },
            success:function(resp){
                $("#modulo-modal .modulo-form").html(resp.div);
            },complete:function(jqXHR, textStatus){
                $("#loading").remove();
            }
        });
        return false;
    });
        
JS
   );
?>

