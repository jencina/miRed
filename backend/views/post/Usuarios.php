<?php
use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'id' => 'list-usuario'.$id,
    'emptyText'=>'',
     'layout' => '{items}',
    'itemOptions' => ['class' => 'item','style'=>'float:left;margin-left: 5px'],
    'itemView' => '_usuario'
]);

?>
