<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
?>

<div id="post-<?= $model->con_id; ?>" class="col-lg-12 posts">
    <div class="portlet panel panel-default panel-border">
        
        <div class="portlet-heading portlet-default panel-heading">
            <h3 class="portlet-title text-dark profile">
                <img src="/advanced/backend/web/admin-theme/images/users/avatar-2.jpg" alt="user-img" class="img-circle">
                <?php $user = $model->usu;?>
                <a href="#"> <?= $user->usu_nombre.' '.$user->usu_apellido ?></a>
            </h3>
            
                <div class="portlet-widgets">
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default69" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                <span class="divider"></span>
                <a href="" id="btn-edit69" class="post-edit" data-id="69"><i class="ion-compose"></i></a>
                <span class="divider"></span>
                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div id="bg-default<?= $model->con_id; ?>" class="panel-collapse collapse in" aria-expanded="true">
            <div class="portlet-body">
                <div class="col-md-12">
                    
                </div>
                <dl class="dl-horizontal m-b-10">
                    <?= $model->con_contenido; ?>
                </dl>
               

            </div>
             <hr class="m-0">
            <div class="panel-body p-t-10 p-b-10" style="position:relative">
                <div class="row">
                    <?= Html::a('<i class="fa fa-thumbs-o-up"></i> Me Gusta',false,['class'=>'like','data-id'=>$model->con_id]);?>
                    
                    <span class="m-r-5"></span>
                    <?= Html::a('<i class="fa fa-reply"></i> Responder');?>
                    <span class="m-r-5"></span>
                    <?= Html::a('<i class="fa fa-share-alt"></i> Compartir');?>
                </div>
            </div>
            
            <hr class="m-0">
            
            <div class="panel-footer">
                <div class="inbox-widget nicescroll" tabindex="5001" style="overflow: hidden; outline: none;">
                    <div class="col-md-12">
                        <?php 
                        $comentarios = backend\models\Conversacion::find()
                                        ->where(['con_id_padre'=>$model->con_id])
                                        ->limit(5)  //hasta
                                        ->offset(1) //desde
                                        ->orderBy([ 'con_fechacreacion' => SORT_ASC])
                                        ->all();
                        
                        foreach ($comentarios as $com){
                               echo $this->render('_respuesta',['model'=>$com]);
                        }
                        ?>
                    </div>
                    <div id="list-comentario<?= $model->con_id; ?>" class="col-md-12">
                        <?php 
                        $mod = new \backend\models\Conversacion();
                        $mod->con_id_padre = $model->con_id;
                        $mod->grupo_id     = $model->grupo_id;
                        $form = ActiveForm::begin([
                            'id' => 'form-respuesta'.$model->con_id,
                            'options'=>['class'=>'respuesta'] ]); ?>
           
                            <?= $form->field($mod, 'con_contenido', ['options' => ['class' => '']])->textarea(['maxlength' => true, 'placeholder' => 'Escribir Respuesta'])->label(false) ?>                
                            <?= $form->field($mod, 'grupo_id')->hiddenInput()->label(false) ?> 
                            <?= $form->field($mod, 'con_id_padre')->hiddenInput()->label(false) ?> 
                        
                            <?= Html::submitButton('Publicar', ['id' => 'btn-guardar', 'class' => $mod->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
