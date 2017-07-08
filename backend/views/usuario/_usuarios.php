<div class="card-box widget-user">
    <div>
        <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle img-thumbnail img-responsive" alt="user">
        <div class="wid-u-info">
            <h4 class="m-t-0 m-b-5"><?= $model->usu_nombre.' '.$model->usu_apellido?></h4>
            <p class="text-muted m-b-5 font-13"><?= $model->usu_email?></p>
            <small class="text-warning"><b>Admin</b></small>
        </div>
    </div>
</div>