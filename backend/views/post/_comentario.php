<a href="#">
    <div class="inbox-item">
        <div class="inbox-item-img"><img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" alt=""></div>
        <p class="inbox-item-author"><?= $model->comUsuario->usu_nombre.' '.$model->comUsuario->usu_apellido ?></p>
        <p class="inbox-item-text"><?= $model->com_comentario ?></p>
        <p class="inbox-item-date"><?= date("H:i A" , strtotime($model->com_fechamodificacion)) ?></p>
    </div>
</a>