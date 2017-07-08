<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
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
            'id' => 'post-listview',
            'itemOptions' => ['class' => 'item-list'],
            'itemView' => '//post/_post',
            'layout'=>'{items}{pager}',
            
            'pager' => [
               // 'class' => \kop\y2sp\ScrollPager::className(),
               // 'triggerText'=>'Cargar Post'
              ]
        ]);
    ?>
    <?php Pjax::end() ?>
</div>

<div class="col-md-5">
    <div class="col-lg-12">
        <div class="panel panel-border panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">USUARIOS</h3>
            </div>
            <div class="panel-body">
                <?php Pjax::begin([
                    'id' => 'post-list',
                    'timeout'=>5500,
                    'enablePushState' => false,
                    // 'clientOptions' => ['method' => 'POST']
                    ]) ?>
                <?php
                    $dataProvider = new ActiveDataProvider([
                        'query' => backend\models\Usuario::find()->where(['emp_id'=>Yii::$app->session->get('empresa')]),
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'post-listview',
                        'itemOptions' => ['class' => 'item-list'],
                        'itemView' => '_usuarios',
                        'layout'=>'{items}{pager}',

                        'pager' => [
                           // 'class' => \kop\y2sp\ScrollPager::className(),
                           // 'triggerText'=>'Cargar Post'
                          ]
                    ]);
                ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>
    
<?php

$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/createcomentario']));
$urlFormUsuario = \yii\helpers\Json::htmlEncode(Url::to(['modulo/agregarusuario']));
$urlFormFile    = \yii\helpers\Json::htmlEncode(Url::to(['modulo/uploadfile']));

$this->registerJs(<<<JS

        $("form.form-comentario").on('beforeSubmit',function(e){
            e.preventDefault();        
            var form =  $(this);
            $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data:$(this).serialize(),
                error:function(){
                    form.find("button").button("reset");
                },
                beforeSend:function(){
                   form.find("button").button("loading");
                },
                success:function(resp){
                    $.pjax.reload({container: '#comentario'+resp.id, async: false});
                },complete:function(jqXHR, textStatus){
                    form.find("input.comentario").val("");
                    form.find("button").button("reset");
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
                   $.pjax.reload({container: '#usuario-'+resp.id, async: false});
                },complete:function(jqXHR, textStatus){
        
                }
            });
            
            return false;
        });
        
        $("form.form-file").on('beforeSubmit',function(e){
            e.preventDefault();  
            $.ajax({
                url: $urlFormFile,
                type:'post',
                dataType:"json",
                data: new FormData( this ),
                type:"post",
                processData: false,
                contentType: false,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
                beforeSend:function(){
                   
                },
                success:function(resp){
                  $.pjax.reload({container: '#file-'+resp.id, async: false});
                },complete:function(jqXHR, textStatus){
        
                }
            });
            
            return false;
        });
        
JS
   );
    
?>


