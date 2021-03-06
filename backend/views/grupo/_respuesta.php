<?php
use yii\bootstrap\Html;

?>

<div class="inbox-item" data-id="<?= $model->con_id;?>">
    <div class="inbox-item-img"><img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-circle" alt=""></div>
    <p class="inbox-item-author"><?= $model->usu->usu_nombre.' '.$model->usu->usu_apellido ?></p>
    <p class="inbox-item-text" style="text-align: justify"><?= $model->con_contenido ?></p>
    <p class="inbox-item-date"><?= date("H:i A" , strtotime($model->con_fechamodificacion)) ?></p>
    
    <div id="interraction<?= $model->con_id; ?>" class="panel-body p-t-10 p-b-0" style="position:relative;font-size: 13px">
        <?= $this->render('_like',['model'=>$model]);?>
    </div>
</div>
