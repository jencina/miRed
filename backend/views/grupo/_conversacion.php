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
                    <?= Html::a('<i class="fa fa-thumbs-o-up"></i> Me Gusta');?>
                    <span class="m-r-5"></span>
                    <?= Html::a('<i class="fa fa-reply"></i> Responder');?>
                    <span class="m-r-5"></span>
                    <?= Html::a('<i class="fa fa-share-alt"></i> Compartir');?>
                </div>
            </div>
            
            <hr class="m-0">
            
            <div class="panel-footer">
                <div class="inbox-widget nicescroll" tabindex="5001" style="overflow: hidden; outline: none;">
                    <div id="list-comentario<?= $model->con_id; ?>" class="col-md-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
