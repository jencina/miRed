<?php
    $this->registerCssFile(Yii::getAlias('@web') . '/admin-theme/css/grupo.css', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div id="group-head" class="col-md-12" style="">
    <div id="grupo-head-line" class="row" style="">
        
    </div>

    <div id="grupo-head-datos" class="row" style="">
        <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" class="img-rounded" style=""/>
        <div class="col-md-12" style="">
            <h2 style=""><span><?= ucwords(strtolower($model->grupo_nombre)); ?></span></h2>
            <p style="">
                <?= $model->grupo_descripcion; ?>
            </p>
        </div>
    </div>

    <div id="group-head-menu" class="row">    
        <?php
        $menu = [];
        $menu[] = ['label' => '<i class="fa fa-navicon" ></i> Post', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/index', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-comments-o" ></i> Conversaciones', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/conversaciones', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-archive" ></i> Archivos', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/archivos', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-calendar" ></i> Eventos', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/archivos', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-cog" ></i> Configuracion', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/configuracion', 'id' => $model->grupo_id]];

        echo \yii\widgets\Menu::widget([
            'options' => ['id' => 'grupo-menu', 'class' => 'nav navbar-nav navbar-left'],
            'items' => $menu,
            'encodeLabels' => false, //allows you to use html in labels
            'activateParents' => true]);
        ?>
    </div>
</div>
