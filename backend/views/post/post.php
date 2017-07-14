<?php

use yii\helpers\Url;
foreach ($post as $p){
   echo  $this->render('_post',['model'=>$p]);
}


$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/createcomentario']));
$this->registerJs(<<<JS

    $(".open-add-user").on("click",function(){
        $(this).parent().find(".add-user").toggle( "slide" )
    });
        
    $(".return-users").on("click",function(){
        $(this).parents(".add-user").toggle( "slide" )
    });
        
    $(".open-add-file").on("click",function(){
        $(this).parent().find(".add-file").toggle( "slide" )
    });
        
    $(".return-files").on("click",function(){
        $(this).parents(".add-file").toggle( "slide" )
    });
        
        
JS
   );

?>
