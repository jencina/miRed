<?php
use yii\widgets\ListView;

foreach ($post as $p){
   echo  $this->render('_post',['model'=>$p]);
}

/*
echo ListView::widget([
     'dataProvider' => $post,
     'id'=>'posts',
     'itemOptions' => ['class' => 'item'],
     'itemView' => '_post',
     'layout'=>'{items}{pager}',
     'pager' => [
         'class' => \kop\y2sp\ScrollPager::className()
        ]
]);*/
?>


