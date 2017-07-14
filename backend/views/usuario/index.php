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
<div id="lista-post" class="col-md-7">
    
</div>

<div class="col-md-5">
    <div class="col-lg-12">
        <div class="panel panel-border panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">USUARIOS</h3>
            </div>
            <div class="panel-body">
                <?php
                Pjax::begin([
                    'id' => 'usuarios-emp-list',
                    'timeout'=>5500,
                    'enablePushState' => false,
                    // 'clientOptions' => ['method' => 'POST']
                    ]) ?>
                <?php
                
                    $dataProvider = new ActiveDataProvider([
                        'query' => backend\models\Usuario::find()
                            ->where(['emp_id'=>Yii::$app->session->get('empresa')])
                            ->andWhere(['<>','usu_id',Yii::$app->user->id ]),
                            
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'usuarios-emp',
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
$urlGetPost     = \yii\helpers\Json::htmlEncode(Url::to(['modulo/getpost']));

$this->registerJs(<<<JS
        
        $(document).on("ready pjax:success",function(e){
            e.preventDefault();  
            $.ajax({
                url: $urlGetPost,
                type:'post',
                dataType:'json',
                data:$(this).serialize(),
                error:function(){
                   // form.find("button").button("reset");
                },
                beforeSend:function(){
                  // form.find("button").button("loading");
                },
                success:function(resp){
                    $("#lista-post").html(resp);
                },complete:function(jqXHR, textStatus){
        
                }
            });
            return false;
        });
        
        $(document).ajaxComplete(function(){
            $("form").on("beforeSubmit",function(){
                if($(this).attr("class") == "form-comentario"){
                    createComentario($(this));
                }else if($(this).attr("class") == "form-usuario"){
                    asignarUsuario($(this));
                }else if($(this).attr("class") == "form-file"){
                    adjuntarDocumento($(this));
                }
                return false;
            });
        });
        
        function adjuntarDocumento(form){
            $.ajax({
                url: $urlFormFile,
                type:'post',
                dataType:"json",
                data: new FormData( form ),
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
        }
        
        function asignarUsuario(form){
            $.ajax({
                url: $urlFormUsuario,
                type:'post',
                dataType:'json',
                data: form.serialize(),
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
                beforeSend:function(){
                   
                },
                success:function(resp){
                   $.pjax.reload({container: '#usuario-'+resp.id, async: false, replace:false,push:true});
                },complete:function(jqXHR, textStatus){
        
                }
            });
            return false;
        }
        
        function createComentario(form){
            $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data:form.serialize(),
                error:function(){
                    form.find("button").button("reset");
                },
                beforeSend:function(){
                   form.find("button").button("loading");
                },
                success:function(resp){
                    //$.pjax.reload({container: '#comentario'+resp.id, async: false});
                },complete:function(jqXHR, textStatus){
                    form.find("input.comentario").val("");
                    form.find("button").button("reset");
                }
            });
            return false;
        }
        
        
        
JS
   );
    
?>


