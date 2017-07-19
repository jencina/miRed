<?php 
    use yii\widgets\ListView;
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'list-file'.$id,
        'emptyText'=>'',
         'layout' => '{items}',
        'itemOptions' => ['class' => 'item','style'=>'margin-left: 5px;float:left','data-pjax' => 0],
        'itemView' => '_file'
    ]);
?>       
