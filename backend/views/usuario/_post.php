<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<div class="col-lg-12">
    <div class="portlet panel panel-<?= $model->mod->mod_color ?> panel-border">
        <div class="portlet-heading portlet-default panel-heading">
            <h3 class="portlet-title text-dark">
                <span class="dropcap text-<?= $model->mod->mod_color ?>"><?= substr($model->mod->mod_nombre, 0, 1) ?></span> Default Heading
            </h3>

            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                <span class="divider"></span>
                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
            </div>
            <div class="clearfix">

            </div>
        </div>
        <div id="bg-default" class="panel-collapse collapse in" aria-expanded="true">

            <div class="portlet-body">
                <div class="col-md-12">
                    
                </div>
                <dl class="dl-horizontal m-b-0">
                    <?php foreach ($model->moduloPostHasModuloRegistros as $reg): ?>
                        <dt>
                            <?= $reg->modReg->mod_reg_nombre ?>
                        </dt>
                        <dd>
                            <?= $reg->contenido ?>
                        </dd>
                    <?php endforeach; ?>
                </dl>
               
            </div>
            <hr class="m-0">
            <div class="panel-body p-t-10 p-b-10" style="position:relative">
                <div class="col-md-12 add-user">
                    <?php
                    $user = new backend\models\ModuloPostHasUsuario();
                    $user->modulo_post_mod_post_id = $model->mod_post_id;
                    $form = ActiveForm::begin([
                        'options'=>['class'=>'form-usuario']
                    ]); ?>
                    
                    <?= $form->field($user, 'usuario_usu_id',['options'=>[
                        'class'=>'input-group','style'=>'min-height: 100%'],                
                        'template'=>''
                        . '<span class="input-group-btn">'
                        . '<button type="button" class="btn waves-effect waves-light btn-danger return-users" ><i class="fa fa-mail-reply"></i></button>'
                        . '</span>'
                        .'{input}'
                        . '<span class="input-group-btn">'
                        . '<button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-plus"></i></button>'
                        . '</span>'
                        ])->dropDownList(ArrayHelper::map(backend\models\Usuario::find()->all(), 'usu_id', 'usu_nombre'),['tag' => null,'class' => 'form-control'])->label(false); ?>
                    <?= $form->field($user, 'modulo_post_mod_post_id')->hiddenInput()->label(false);?>
                    <?php ActiveForm::end(); ?>
                </div>
                
                <a class="btn btn-success  waves-effect waves-light open-add-user" ><i class="fa fa-users"></i></a>
                <img width="40" src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="<?= $model->modPostAsignadoUsu->usu_nombre.' '.$model->modPostAsignadoUsu->usu_apellido;?>">
                
                <?php foreach($model->moduloPostHasUsuarios as $usu): ?>
                    <img width="40" src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="<?= $usu->usuarioUsu->usu_nombre.' '.$usu->usuarioUsu->usu_apellido;?>">
                <?php endforeach; ?>
            
            </div>

            <hr class="m-0">
            <div class="panel-body p-t-10 p-b-10" style="position:relative">
                <div class="col-md-12 add-file">
                    <?php
                    $user = new backend\models\ModuloPost();
                    $form = ActiveForm::begin([
                        'options'=>['class'=>'form-comentario']
                    ]); ?>
                    
                    <?= $form->field($user, 'usuario_usu_id',['options'=>[
                        'class'=>'input-group','style'=>'min-height: 100%'],                
                        'template'=>''
                        . '<span class="input-group-btn">'
                        . '<button type="button" class="btn waves-effect waves-light btn-danger return-files" ><i class="fa fa-mail-reply"></i></button>'
                        . '</span>'
                        .'{input}'
                        . '<span class="input-group-btn">'
                        . '<button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-upload"></i></button>'
                        . '</span>'
                        ])->fileInput(['class'=>'form-control'])->label(false); ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <a class="btn btn-purple  waves-effect waves-light open-add-file"><i class="fa fa-upload"></i></a>
            </div>
            
            <div class="panel-footer">
                <div class="inbox-widget nicescroll" tabindex="5001" style="overflow: hidden; outline: none;">
                    <?php foreach ($model->moduloPostComentarios as $com):?>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" alt=""></div>
                            <p class="inbox-item-author"><?= $com->comUsuario->usu_nombre.' '.$com->comUsuario->usu_apellido ?></p>
                            <p class="inbox-item-text"><?= $com->com_comentario ?></p>
                            <p class="inbox-item-date"><?= date("H:i A" , strtotime($com->com_fechamodificacion)) ?></p>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
                
                <?php 
                $comentario = new \backend\models\ModuloPostComentario();
                $comentario->com_mod_post_id = $model->mod_post_id;
                $form = ActiveForm::begin([
                    'options'=>['class'=>'form-comentario']
                ]); ?>
                <div class="row">
                    <?php 
                    $fieldOptions = [
                        'options' => ['class' => ''],
                        'inputTemplate' => ""
                        . '<div class="col-sm-9 todo-inputbar">'
                        . "{input}"
                        . "</div>"
                    ];?>
                    
                    <?= $form->field($comentario, 'com_comentario',$fieldOptions)->textInput(['placeholder'=>'Comentario...'])->label(false); ?>
                    <?= $form->field($comentario, 'com_mod_post_id')->hiddenInput()->label(false) ?>
                    
                    <div class="col-sm-3 todo-send">
                        <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="submit" id="todo-btn-submit">Add</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);

$this->registerJs(<<<JS

    $(".open-add-user").on("click",function(){
        $(this).parent().find(".add-user").toggle( "slide" )
    });
        
    $(".return-users").on("click",function(){
        $(this).parents(".add-user").toggle( "slide" )
    });
        
    $(".open-add-file").on("click",function(){
        $(this).parent().find(".add-file").toggle( "slide" )
    });
        
    $(".return-files").on("click",function(){
        $(this).parents(".add-file").toggle( "slide" )
    });
        
    
        
JS
   );

?>
