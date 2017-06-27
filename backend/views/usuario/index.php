<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Muro';
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'] = 'Bienvenido';
?>
<div class="col-md-7">
    <?php Pjax::begin([
        'id' => 'post-list',
        'timeout'=>5500,
        'enablePushState' => false,
        // 'clientOptions' => ['method' => 'POST']
        ]) ?>
    <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_post',
            
            'pager' => [
                'class' => \kop\y2sp\ScrollPager::className(),
                'triggerText'=>'Cargar Post'
              ]
        ]);
    ?>
    <?php Pjax::end() ?>
</div>



