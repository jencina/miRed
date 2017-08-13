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
            
            <h3 class="portlet-title text-dark">
                <span class="dropcap text-"></span>
            </h3>
            
        </div>
        <div id="bg-default<?= $model->con_id; ?>" class="panel-collapse collapse in" aria-expanded="true">

            <div class="portlet-body">
                <div class="col-md-12">
                    
                </div>
                <dl class="dl-horizontal m-b-0">
                    <?= $model->con_contenido; ?>
                </dl>
               
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
