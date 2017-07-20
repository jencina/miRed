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

<div id="lista-post" class="col-md-7" >
    <div class="content"></div>
    <ul id="pagination" style="display: none">
        <li></li> 
    </ul>    
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
$updateFile     = \yii\helpers\Json::htmlEncode(Url::to(['modulo/updatefiles']));
$updateUsuarios = \yii\helpers\Json::htmlEncode(Url::to(['modulo/updateusuarios']));

$urlGetPost     = \yii\helpers\Json::htmlEncode(Url::to(['modulo/getpost']));

$this->registerJs(<<<JS
               
    $(document).on("ready pjax:success",function(e){
        e.preventDefault();  
        $.ajax({
            url: $urlGetPost,
            type:'post',
            //dataType:'json',
            data:$(this).serialize(),
            error:function(){
                //form.find("button").button("reset");
            },
            beforeSend:function(){
                //form.find("button").button("loading");
            },
            success:function(resp){
                $("#lista-post .content").html(resp);
            },complete:function(jqXHR, textStatus){

            }
        });
        return false;
    });
        
    $(window).bind('scroll', function() {
        if($(window).scrollTop() >= $('#lista-post').offset().top + $('#lista-post').outerHeight()-window.innerHeight) {
            console.log(1);
        }
    });

    $(document).ajaxComplete(function(){
        
        $("form.form-usuario").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = $(this);
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
                   updateUsuarios(resp.id);
                },complete:function(jqXHR, textStatus){

                }
            });
            return false;
        });

        $("form.form-comentario").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = $(this);
             $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data: form.serialize(),
                error:function(){
                    form.find("button").button("reset");
                },
                beforeSend:function(){
                   form.find("button").button("loading");
                },
                success:function(resp){
                    $("#list-comentario"+resp.id).append(resp.coment);
                },complete:function(jqXHR, textStatus){
                    form.find("input.comentario").val("");
                    form.find("button").button("reset");
                }
            });
            return false;
        });

        $("form.form-file").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
        
            var form = $(this);
            $.ajax({
                url: $urlFormFile,
                type:'post',
                dataType:"json",
                data: new FormData( form[0] ),
                processData: false,
                contentType: false,
                error: function (xhr, ajaxOptions, thrownError) {
                   // alert(xhr.status);
                   // alert(thrownError);
                },
                beforeSend:function(){

                },
                success:function(resp){
                    updateFiles(resp.id);
                    //$.pjax.reload({container: '#file-'+resp.id,url:$updateFile,async: false,push:false,timeout:5000});
                },complete:function(jqXHR, textStatus){
resp.id
                }
            });
            return false;
        });

        $(".open-add-user").on("click",function(e){
        e.preventDefault();
            e.stopImmediatePropagation();
            $(this).parent().find(".add-user").toggle( "slide" );
        });

        $(".return-users").on("click",function(e){
        e.preventDefault();
            e.stopImmediatePropagation();
            $(this).parents(".add-user").toggle( "slide" );
        });

        $(".open-add-file").on("click",function(e){
        e.preventDefault();
            e.stopImmediatePropagation();
            $(this).parent().find(".add-file").toggle( "slide" );
        });

        $(".return-files").on("click",function(e){
        e.preventDefault();
            e.stopImmediatePropagation();
            $(this).parents(".add-file").toggle( "slide" );
        });
        
        function updateFiles(id){
            $.ajax({
                url: $updateFile,
                type:'post',
                //dataType:"json",
                data: {id:id},
                error: function (xhr, ajaxOptions, thrownError) {
                   // alert(xhr.status);
                   // alert(thrownError);
                },
                beforeSend:function(){

                },
                success:function(resp){
                    $("#list-file"+id).replaceWith(resp);
                },complete:function(jqXHR, textStatus){

                }
            });
            return false;
        }
        
        function updateUsuarios(id){
            $.ajax({
                url: $updateUsuarios,
                type:'post',
                //dataType:"json",
                data: {id:id},
                error: function (xhr, ajaxOptions, thrownError) {
                   // alert(xhr.status);
                   // alert(thrownError);
                },
                beforeSend:function(){

                },
                success:function(resp){
                    $("#list-usuario"+id).replaceWith(resp);
                },complete:function(jqXHR, textStatus){

                }
            });
            return false;
        }
        
    });  
        
        
        
    
        
JS
   );


//$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);
    
?>


