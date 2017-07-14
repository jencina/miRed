<?php if($model->not_tipo == 1){?>
    <a href="javascript:void(0);" class="list-group-item">
        <div class="media">
            <div class="pull-left p-r-10">
                <span class="dropcap text-pink">U</span>
                <!--<em class="fa noti-primary">U</em>-->
            </div>
            <div class="media-body">
                <h5 class="media-heading"><?= ucwords($model->notUsu->usu_nombre.' '.$model->notUsu->usu_nombre);?></h5>
                <p class="m-0">
                    <small><?= $model->not_titulo?></small>
                </p>
                <h5 class="media-heading text-pink"><?= ucwords($model->notPost->mod->mod_nombre.' #'.$model->notPost->mod_post_id)?></h5>
            </div>
        </div>
    </a>
<?php }else if($model->not_tipo == 2){?>
    <a href="javascript:void(0);" class="list-group-item">
        <div class="media">
            <div class="pull-left p-r-10">
                <em class="fa fa-diamond noti-primary"></em>
            </div>
            <div class="media-body">
                <h5 class="media-heading">A new order has been placed A new
                    order has been placed</h5>
                <p class="m-0">
                    <small>There are new settings available</small>
                </p>
            </div>
        </div>
    </a>
<?php } ?>

