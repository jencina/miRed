<?php 
use yii\bootstrap\Html;

?>
<div class="col-sm-4">
    <div class="gal-detail thumb">
        <a href="#" class="image-popup" title="Screenshot-2">
            <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/gallery/1.jpg" class="thumb-img" alt="work-thumbnail">
        </a>
        <h4 class="text-center"><?= $model->mod_nombre?></h4>
        <div class="ga-border"></div>
        <p class="text-muted text-center">
            <small>
                <?= Html::a('<i class="fa fa-eye"></i>', '', ['data-id' => $model->mod_id,'class' => 'modulo-editar btn btn-purple btn-sm waves-effect m-t-10 waves-light']) ?>
                <?= Html::a('<i class="fa fa-pencil-square-o"></i>', '', ['data-id' => $model->mod_id,'class' => 'modulo-editar btn btn-success btn-sm waves-effect m-t-10 waves-light']) ?>
                <?= Html::a('<i class="fa fa-trash-o"></i>','', ['data-id' => $model->mod_id,'class' => 'modulo-eliminar btn btn-danger btn-sm waves-effect m-t-10 waves-light','data-pjax'=>0]) ?>
            </small>
        </p>
    </div>
</div>


