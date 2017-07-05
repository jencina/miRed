<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
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

<?php

$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/createcomentario']));
$urlFormUsuario = \yii\helpers\Json::htmlEncode(Url::to(['modulo/agregarusuario']));

$this->registerJs(<<<JS

        $("form.form-comentario").on('beforeSubmit',function(e){
            e.preventDefault();        
            $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data:$(this).serialize(),
                beforeSend:function(){
                   
                },
                success:function(resp){
                  
                },complete:function(jqXHR, textStatus){
        
                }
            });
            
            return false;
        });
        
        $("form.form-usuario").on('beforeSubmit',function(e){
            e.preventDefault();        
            console.log('entro');
            $.ajax({
                url: $urlFormUsuario,
                type:'post',
                dataType:'json',
                data:$(this).serialize(),
                beforeSend:function(){
                   
                },
                success:function(resp){
                  
                },complete:function(jqXHR, textStatus){
        
                }
            });
            
            return false;
        });
        
JS
   );
    
?>


