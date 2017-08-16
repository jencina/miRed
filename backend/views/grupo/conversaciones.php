<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */

$this->title = 'Update Grupo: ' . $model->grupo_id;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucwords(strtolower($model->grupo_nombre))), 'url' => ['view', 'id' => $model->grupo_id]];
$this->params['breadcrumbs'][] = 'Configuracion';
$this->params['tittle']        = 'Grupo';

?>

<?= $this->render('_header', ['model' => $model]); ?>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs tabs" style="width: 100%;">
                    <li class="tab active" style="width: 25%;">
                        <a href="#home-12" data-toggle="tab" aria-expanded="true" class="active">
                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                            <span class="hidden-xs">Conversaciones</span>
                        </a>
                    </li>
                    
                    <li class="tab" style="width: 25%;">
                        <a href="#profile-12" data-toggle="tab" aria-expanded="false" class="">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Encuenta</span>
                        </a>
                    </li>
                    
                    <div class="indicator" style="right: 394px; left: 0px;"></div>
                </ul>
                
                <div class="tab-content p-0">

                    <div class="tab-pane active " id="home-12" style="display: block;">
                        <?php $form = ActiveForm::begin(['id' => 'form-conversacion']); ?>
                        <div class="panel-body">               
                            <?= $form->field($conversacion, 'con_contenido', ['options' => ['class' => '']])->textarea(['maxlength' => true, 'placeholder' => 'Iniciar Conversacion...'])->label(false) ?>                
                            <?= $form->field($conversacion, 'grupo_id')->hiddenInput()->label(false) ?> 
                        </div>
                        
                        <div class="panel-footer">
                            <?= Html::submitButton('Publicar', ['id' => 'btn-guardar', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>   
                    </div>

                    <div class="tab-pane" id="profile-12" style="display: none;">
                        
                        <?php $form = ActiveForm::begin(['id' => 'form-encuesta']); ?>
                        
                        <div class="panel-body">               
                            <?= $form->field($encuesta, 'con_contenido', ['options' => ['class' => '']])->textarea(['maxlength' => true, 'placeholder' => 'Iniciar Conversacion...'])->label(false) ?>                
                            <?= $form->field($encuesta, 'grupo_id')->hiddenInput()->label(false) ?> 
                        </div>
                        
                        <div class="panel-footer">
                            <?= Html::submitButton('Publicar', ['id' => 'btn-guardar', 'class' => $encuesta->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                        
                        <?php ActiveForm::end(); ?>   
                    </div>
                </div>
            </div>

            <div id="lista-post" class="col-md-12" >
                <div class="content">
                <?php
                Pjax::begin([
                    'id'       => 'list-conversaciones',
                    'timeout'  => 5500,
                    'enablePushState' => false,
                        // 'clientOptions' => ['method' => 'POST']
                ])
                ?>
                    
                <?php
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'id'           => 'usuarios-emp',
                        'itemOptions'  => ['class' => 'item-list row'],
                        'itemView'     => '_conversacion',
                        'layout'       => '{items}{pager}',
                        'pager' => [
                           //  'class' => \kop\y2sp\ScrollPager::className(),
                           //  'triggerText'=>'Cargar Post'
                        ]
                    ]);
                ?>
                <?php Pjax::end() ?>
                </div>  
            </div>

        </div>
    </div>  

    <div class="col-md-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">Autor</p>
                </div>
            </div>
        </div>

        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">Administrador</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$createConversacion   = \yii\helpers\Json::htmlEncode(Url::to(['grupo/createconversacion']));
$createRespuesta      = \yii\helpers\Json::htmlEncode(Url::to(['grupo/create-respuesta']));
$urlGetConversaciones = \yii\helpers\Json::htmlEncode(Url::to(['grupo/getconversaciones']));

$urlCreateLike = \yii\helpers\Json::htmlEncode(Url::to(['grupo/create-like']));

$this->registerJs(<<<JS
        
    $(".like").on('click',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
   
        var id = $(this).attr("data-id");
        
        $.ajax({
            url: $urlCreateLike,
            type:'post',
            dataType:'json',
            data: {id:id},
            error:function(){
                $.Notification.notify("error","right-bottom","Me Gusta","Algo ocurrio al agregar 'Me Gusta'");
            },
            beforeSend:function(){
               //form.find("button").button("loading");
            },
            success:function(resp){
                //$.pjax.reload({container:"#list-conversaciones"}); 
            },complete:function(jqXHR, textStatus){
                //form[0].reset();
                //form.find("button").button("reset");
            }
        });
        return false;
    });     
        
    $("form.respuesta").on("beforeSubmit",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        
        var form = $(this);
        $.ajax({
            url: $createRespuesta,
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
                 $.pjax.reload({container:"#list-conversaciones"}); 
            },complete:function(jqXHR, textStatus){
                form[0].reset();
                form.find("button").button("reset");
            }
        });
        return false;
    });    
    
    $("#form-conversacion").on("beforeSubmit",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        var form = $(this);
        $.ajax({
            url: $createConversacion,
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
                 $.pjax.reload({container:"#list-conversaciones"}); 
            },complete:function(jqXHR, textStatus){
                form[0].reset();
                form.find("button").button("reset");
            }
        });
        return false;
    });
        
JS
);
?>