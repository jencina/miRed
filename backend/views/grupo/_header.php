<?php
    $this->registerCssFile(Yii::getAlias('@web') . '/admin-theme/css/grupo.css', ['depends' => [yii\web\JqueryAsset::className()]]);

    function hex2rgb($hex,$oscuro = 0) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
           $r = hexdec(substr($hex,0,1).substr($hex,0,1));
           $g = hexdec(substr($hex,1,1).substr($hex,1,1));
           $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
           $r = hexdec(substr($hex,0,2));
           $g = hexdec(substr($hex,2,2));
           $b = hexdec(substr($hex,4,2));
        }
        $r = $r+$oscuro;
        $g = $g+$oscuro;
        $b = $b+$oscuro;
        $rgb = "rgb($r, $g, $b)";
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
?>

<div id="group-head" class="col-md-12" style="background: <?= hex2rgb($model->grupo_color);?>">
    <div id="grupo-head-line" class="row" style="background: <?= hex2rgb($model->grupo_color,-30);?>">
        
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
        $menu[] = ['label' => '<i class="fa fa-calendar" ></i> Eventos', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/eventos', 'id' => $model->grupo_id]];
        $menu[] = ['label' => '<i class="fa fa-cog" ></i> Configuracion', 'options' => ['class' => 'has-sub'], 'url' => ['grupo/configuracion', 'id' => $model->grupo_id]];

        echo \yii\widgets\Menu::widget([
            'options' => ['id' => 'grupo-menu', 'class' => 'nav navbar-nav navbar-left'],
            'items' => $menu,
            'encodeLabels' => false, //allows you to use html in labels
            'activateParents' => true]);
        ?>
    </div>
</div>
