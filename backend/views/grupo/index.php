<?php

use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['tittle'] = 'Grupo';
$this->params['grupo']  = $model->grupo_id;
$this->params['grupo-model']  = $model;
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('_header',['model'=>$model]);?>

<div class="row">
    
    <div id="lista-post" class="col-md-7">
        <div class="content"></div>
        <ul id="pagination" style="display: none">
            <li class="active"><?= \yii\bootstrap\Html::a('',['modulo/getpost','limit'=>5,'offset'=>1]); ?></li> 
        </ul>  
    </div>

    <div class="col-md-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">USUARIOS</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        Pjax::begin([
                            'id' => 'usuarios-emp-list',
                            'timeout' => 5500,
                            'enablePushState' => false,
                                // 'clientOptions' => ['method' => 'POST']
                        ])
                        ?>
                        <?php
                        $dataProvider = new ActiveDataProvider([
                            'query' => backend\models\Usuario::find()
                                    ->where(['emp_id' => Yii::$app->session->get('empresa')])
                                    ->andWhere(['<>', 'usu_id', Yii::$app->user->id]),
                            'pagination' => [
                                'pageSize' => 10,
                            ],
                        ]);
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'id' => 'usuarios-emp',
                            'itemOptions' => ['class' => 'item-list'],
                            'itemView' => '//usuario/_usuarios',
                            'layout' => '{items}{pager}',
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

            <div class="col-md-12">
                <div class="card-box">
                    <div id="calendar"></div>
                </div>
            </div> <!-- end col -->
        </div>    
    </div>
</div>



<?php

$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/createcomentario']));
$urlFormUsuario = \yii\helpers\Json::htmlEncode(Url::to(['modulo/agregarusuario']));
$urlFormFile    = \yii\helpers\Json::htmlEncode(Url::to(['modulo/uploadfile']));
$updateFile     = \yii\helpers\Json::htmlEncode(Url::to(['modulo/updatefiles']));
$updateUsuarios = \yii\helpers\Json::htmlEncode(Url::to(['modulo/updateusuarios']));

$urlGetPost     = \yii\helpers\Json::htmlEncode(Url::to(['grupo/getpost']));
$updatePost     = \yii\helpers\Json::htmlEncode(Url::to(['modulo/updatepost']));

$this->registerJs(<<<JS
               
    $(document).on("ready pjax:success",function(e){
        e.preventDefault();  
        loadPosts();
    });
        

    function loadPosts(){
        $.ajax({
            url: $urlGetPost,
            type:'post',
            error:function(){
                //form.find("button").button("reset");
            },
            beforeSend:function(){
                //form.find("button").button("loading");
            },
            success:function(resp){
                $("#lista-post .content").append(resp);
            },complete:function(jqXHR, textStatus){
        
            }
        });
        return false;
    }    
        
    

    $(document).ajaxComplete(function(){
        
        $('textarea.comentario').on('keydown', function(e){
            if(e.which == 13) {
                //$(this).parents("form.form-comentario").submit();
                e.preventDefault();
            }
        }).on('input', function(){
            $(this).height(1);
            var totalHeight = $(this).prop('scrollHeight') - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom'));
            $(this).height(totalHeight);
        });
       
        $('[data-toggle="tooltip"]').tooltip();
        
        $("a.post-edit").on("click",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
        
            var id = $(this).attr("data-id");

            $.ajax({
                url: $updatePost,
                type:'post',
                dataType:'json',
                data:{mod_post_id:id},
                beforeSend:function(){
                   $("#modulo-modal").modal("toggle");
                },
                success:function(resp){
                   $("#modulo-modal .modal-body").html(resp.div);
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
                    form[0].reset();
                    form.find("button").button("reset");
                }
            });
            return false;
        });
        
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
                    form.find("button.add-users").button("reset");
                    form.find("button.return-users").attr("disabled",false);
                    form[0].reset();
                    form.parent().toggle( "slide" ); 
                    $.Notification.notify("error","right-bottom","Agregar Usuario","Algo ocurrio al agregar usuario");
                },
                beforeSend:function(){
                    form.find("button.add-users").button("loading");
                    form.find("button.return-users").attr("disabled",true);
                },
                success:function(resp){
                   if(resp.status == "success"){
                      updateUsuarios(resp.id);
                   }
                },complete:function(jqXHR, textStatus){
                    form.find("button.add-users").button("reset");
                    form.find("button.return-users").attr("disabled",false);
                    form[0].reset();
                    if(jqXHR.responseJSON.status == "success"){
                        form.parent().toggle( "slide" );        
                        $.Notification.notify("success","right-bottom","Agregar Usuario","Usuario agregado correctamente!");
                    }else{
                        $.Notification.notify("error","right-bottom","Agregar Usuario",jqXHR.responseJSON.msj);
                    }
                }
            });
            return false;
        });

        $("form.form-file").on("beforeSubmit",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var form =  $(this);
            $(this).ajaxSubmit({
                url: $urlFormFile,
                type:'post',
                dataType:"json",
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    form.next().children().attr("style","width:"+percentVal);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    form.find("button.upload-files").button("reset");
                    form.find("button.return-files").attr("disabled",false);
                    form[0].reset();
                    form.next().children().attr("style","width:0%");
                    form.parent().toggle( "slide" ); 
                    $.Notification.notify("error","right-bottom","Subir Archivo","Algo ocurrio al subir el archivo");
                },
                beforeSend:function(){
                    form.find("button.upload-files").button("loading");
                    form.find("button.return-files").attr("disabled",true);
                },
                success:function(resp){
                    updateFiles(resp.id);
                },complete:function(jqXHR, textStatus){
                    form.find("button.upload-files").button("reset");
                    form.find("button.return-files").attr("disabled",false);
                    form[0].reset();
                    form.next().children().attr("style","width:0%");
                    
                    form.parent().toggle( "slide" );        
                    $.Notification.notify("success","right-bottom","Subir Archivo","Archivo subido correctamente!");
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
                data: {id:id},               
                error: function (xhr, ajaxOptions, thrownError) {
                    $.Notification.notify("error","right-bottom","Update Archivos","Algo ocurrio al actualizar lista de archivos");
                    $("#bg-default"+id).find("a.open-add-file").button("reset");
                },
                beforeSend:function(){
                    $("#bg-default"+id).find("a.open-add-file").button("loading");
                },
                success:function(resp){
                    $("#list-file"+id).replaceWith(resp);
                },complete:function(jqXHR, textStatus){
                    $("#bg-default"+id).find("a.open-add-file").button("reset");
                }
            });
            return false;
        }
        
        function updateUsuarios(id){
            $.ajax({
                url: $updateUsuarios,
                type:'post',
                data: {id:id},
                error: function (xhr, ajaxOptions, thrownError) {
                    $.Notification.notify("error","right-bottom","Update Usuarios","Algo ocurrio al actualizar lista de usuarios");
                    $("#bg-default"+id).find("a.open-add-user").button("reset");
                },
                beforeSend:function(){
                    $("#bg-default"+id).find("a.open-add-user").button("loading");
                },
                success:function(resp){
                    $("#list-usuario"+id).replaceWith(resp);
                },complete:function(jqXHR, textStatus){
                    $("#bg-default"+id).find("a.open-add-user").button("reset");
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





