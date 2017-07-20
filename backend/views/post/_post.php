<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
?>

<div class="col-lg-12 posts">
    <div class="portlet panel panel-<?= $model->mod->mod_color ?> panel-border">
        <div class="portlet-heading portlet-default panel-heading">
            <h3 class="portlet-title text-dark">
                <span class="dropcap text-<?= $model->mod->mod_color ?>"><?= substr($model->mod->mod_nombre, 0, 1) ?></span><?= Html::a($model->modUsu->usu_nombre.' '.$model->modUsu->usu_apellido,"#"); ?>  <?= $model->mod_post_titulo?> <?= Html::a($model->mod->mod_nombre.' #'.$model->mod_post_id,"#")?>
            </h3>

            <div class="portlet-widgets">
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default<?= $model->mod_post_id ?>" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                <span class="divider"></span>
                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
            </div>
            <div class="clearfix">

            </div>
        </div>
        <div id="bg-default<?= $model->mod_post_id ?>" class="panel-collapse collapse in" aria-expanded="true">

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
                        'id' => 'usuario-form'.$model->mod_post_id,
                        'enableClientValidation'=>false,
                        'options' =>['class'=>'form-usuario','data-pjax' => false ]
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
                
                <a class="btn btn-success  waves-effect waves-light open-add-user" style="float:left" ><i class="fa fa-users"></i></a>
                <img width="40" style="float:left;margin-left: 5px" src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="<?= $model->modPostAsignadoUsu->usu_nombre.' '.$model->modPostAsignadoUsu->usu_apellido;?>">
                <?php 
                    $dataProvider = new ActiveDataProvider([
                        'query' => backend\models\ModuloPostHasUsuario::find()->where(['modulo_post_mod_post_id'=>$model->mod_post_id]),
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    echo $this->render('Usuarios',['dataProvider'=>$dataProvider,'id'=>$model->mod_post_id]);
                ?>
            </div>

            <hr class="m-0">
            <div class="panel-body p-t-10 p-b-10" style="position:relative">
                <div class="col-md-12 add-file">
                    <?php
                    $file = new backend\models\UploadForm();
                    $file->parent_id = $model->mod_post_id;
                    $form = ActiveForm::begin([                       
                        'id' => 'file-form'.$model->mod_post_id,
                        'enableClientValidation' => false,
                        'options' => ['class' => 'form-file','data-pjax' => 0 ]
                    ]); ?>
                    
                    <?= $form->field($file, 'imageFiles',['options'=>[
                        'class'=>'input-group','style'=>'min-height: 100%'],                
                        'template'=>''
                        . '<span class="input-group-btn">'
                        . '<button type="button" class="btn waves-effect waves-light btn-danger return-files" ><i class="fa fa-mail-reply"></i></button>'
                        . '</span>'
                        .'{input}'
                        . '<span class="input-group-btn">'
                        . '<button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-upload"></i></button>'
                        . '</span>'
                        ])->fileInput(['class'=>'form-control'])->label(false); ?>
                    <?= $form->field($file, 'parent_id')->hiddenInput()->label(false);?>
                    <?php ActiveForm::end(); ?>
                </div>
                <a class="btn btn-purple  waves-effect waves-light open-add-file" style='float:left'><i class="fa fa-upload"></i></a>
                <?php $dataProvider = new ActiveDataProvider([
                        'query' => backend\models\ModuloPostFiles::find()->where(['file_post_id'=>$model->mod_post_id]),
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    echo $this->render('Files',['dataProvider'=>$dataProvider,'id'=>$model->mod_post_id]);
                ?>             
            </div>
            
            <div class="panel-footer">
                <div class="inbox-widget nicescroll" tabindex="5001" style="overflow: hidden; outline: none;">
                    <div id="list-comentario<?= $model->mod_post_id; ?>" class="col-md-12">
                    <?php 
                        $comentarios = backend\models\ModuloPostComentario::find()
                                        ->where(['com_mod_post_id'=>$model->mod_post_id])
                                        ->limit(5)  //hasta
                                        ->offset(1) //desde
                                        ->orderBy([ 'com_fechamodificacion' => SORT_ASC])
                                        ->all();
                        
                        foreach ($comentarios as $com){
                               echo $this->render('_comentario',['model'=>$com]);
                        }
                        ?>
                    </div>
                </div>
                
                <?php 
                $comentario = new \backend\models\ModuloPostComentario();
                $comentario->com_mod_post_id = $model->mod_post_id;
                $form = ActiveForm::begin([
                    'id'=>'comentario-form'.$model->mod_post_id,
                    'enableClientValidation'=>false,
                    'options'=>['class'=>'form-comentario','data-pjax' => false ]
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
                    
                    <?= $form->field($comentario, 'com_comentario',$fieldOptions)->textInput(['class'=>'form-control comentario', 'placeholder'=>'Comentario...'])->label(false); ?>
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
