<?php 
use yii\bootstrap\Html;
?> 
<div class="row">
    <?php
        $c     = count($model->usus);
        $count = ($c > 0)?'<span class="badge badge-pink">'.$c.'</span>':'';;

        if(!$model->like){
            echo  Html::a('<i class="fa fa-thumbs-o-up"></i> Me Gusta '.$count,false,['class'=>'like','data-id'=>$model->con_id]);
        }else{
            echo  Html::a('<i class="fa fa-thumbs-o-up"></i> Ya no me Gusta '.$count,false,['class'=>'dislike','data-id'=>$model->con_id]);
        }
    ?>
    <span class="m-r-5"></span>
    <?= Html::a('<i class="fa fa-reply"></i> Responder');?>
    <span class="m-r-5"></span>
    <?= Html::a('<i class="fa fa-share-alt"></i> Compartir');?>
</div>
