<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AdminAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
     <script src="<?=Yii::getAlias('@web');?>/admin-theme/js/modernizr.min.js"></script>
</head>
<body class="fixed-left">
<?php $this->beginBody() ?>    
    
    <div id="wrapper" style="overflow: auto">
        
        <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><i class="md md-equalizer"></i> <span>Minton</span> </a>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                <input type="text" placeholder="Search..." class="form-control app-search-input">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"
                                       data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span
                                            class="badge badge-xs badge-pink">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notificaciones</li>
                                        <li class="list-group nicescroll notification-list">
                                            <?php Pjax::begin([
                                                'id' => 'notificacion-list',
                                                'timeout'=>5500,
                                                'enablePushState' => false,
                                                // 'clientOptions' => ['method' => 'POST']
                                                ]) ?>
                                            <?php
                                                $dataProvider = new ActiveDataProvider([
                                                    'query' => \backend\models\Notificacion::find()
                                                        ->where(['not_usu_id_para'=>Yii::$app->user->id]),
                                                    'sort'=> ['defaultOrder' => ['not_fechamodificacion'=>SORT_DESC]], 
                                                    'pagination' => [
                                                        'pageSize' => 5,
                                                    ],
                                                ]);
                                                
                                                echo ListView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'id' => 'post-listview',
                                                    'itemOptions' => ['class' => 'item-list'],
                                                    'itemView' => '//post/_notificacion',
                                                    'layout'=>'{items}{pager}',

                                                    'pager' => [
                                                       // 'class' => \kop\y2sp\ScrollPager::className(),
                                                       // 'triggerText'=>'Cargar Post'
                                                      ]
                                                ]);
                                            ?>
                                            <?php Pjax::end() ?>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0);" class=" text-right">
                                                <small><b>See all notifications</b></small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i
                                            class="md md-settings"></i></a>
                                </li>
                                <li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle waves-effect profile" data-toggle="dropdown"
                                           role="button" aria-haspopup="true" aria-expanded="false">
                                            <img  src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" alt="user-img" class="img-circle">
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Mi Perfil</a></li>
                                            <li>
                                                <?= \yii\bootstrap\Html::a('Salir',['site/logout'],['data-method'=>'post'])?>
                                            </li>
                                        </ul>
                                    </li>
                                </li>

                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
        <!-- Top Bar End -->
            
        <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <?php
                            $menu = [];
                            $menu[] = ['label'=>'MAIN','options'=> ['class'=>'menu-title']];
                            $menu[] = ['label' => '<i class="ti-home"></i><span>'.Yii::t('app', 'Home').'</span>','icon'=>'fa-home','options'=> ['class'=>'has-sub'], 'url' => ['/usuario/index']];
                            
                            //********** MODULOS *************
                            $menu[] = ['label'=>'MODULOS','options'=> ['class'=>'menu-title']];
                            $modulos = \backend\models\Modulo::find()->where(['emp_id'=>Yii::$app->user->identity->emp_id,'mod_activo'=>1])->all();
                            foreach ($modulos as $mod){
                                $menu[] = ['label' => '<i class="fa fa-circle-o text-'.$mod->mod_color.'"></i> <span>'.Yii::t('app', ucwords(strtolower($mod->mod_nombre))).'</span>','options'=> ['id'=>'create-modulo'.$mod->mod_id,'data-id'=>$mod->mod_id,'class'=>'has-sub modulo'], 'url' => "#modulo-modal"];
                            }
                            
                            //********** GRUPOS *************
                            $menu[] = ['label'=>'GRUPOS','options'=> ['class'=>'menu-title']];
                            $menu[] = ['label' =>'<i class="fa fa-plus"></i><span> Nuevo Grupo</span>','options'=> ['id'=>'create-grupo','class'=>'has-sub'], 'url' => "#grupo-modal"];
                            
                            $grupos = \backend\models\Grupo::find()->where(['emp_id'=>Yii::$app->user->identity->emp_id,'grupo_activo'=>1])->all();
                            foreach ($grupos as $grupo){
                                $menu[] = ['label' => '<i class="fa fa-circle-o text-'.$grupo->grupo_color.'"></i><span>'.Yii::t('app', ucwords(strtolower($grupo->grupo_nombre))).'</span>','options'=> ['id'=>'grupo-'.$grupo->grupo_id,'data-id'=>$grupo->grupo_id,'class'=>'has-sub'], 'url' => ['grupo/index','id'=>$grupo->grupo_id]];
                            }
                            
                            echo \yii\widgets\Menu::widget([
                                    'options' => ['class' => ''],
                                    'items' => $menu,
                                    'submenuTemplate' => "\n<ul class='submenu'>\n{items}\n</ul>\n",
                                    'encodeLabels' => false, //allows you to use html in labels
                                    'activateParents' => true ]);
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="user-detail">
                    <div class="dropup">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <img  src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-2.jpg" alt="user-img" class="img-circle">
                            <span class="user-info-span">
                                <h5 class="m-t-0 m-b-0"><?= Yii::$app->user->identity->usu_nombre.' '.Yii::$app->user->identity->usu_apellido?></h5>
                                <p class="text-muted m-b-0">
                                    <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                                </p>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        <!-- Left Sidebar End --> 
        
         <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->                      
        <div id="content-page" class="content-page" style="overflow: auto">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <?= Breadcrumbs::widget([
                                    'tag'=>'ol',
                                    'options'=>['class'=>'breadcrumb pull-right'],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                                <h4 class="page-title"><?= isset($this->params['tittle']) ? $this->params['tittle'] :'';?></h4>
                            </div>
                        </div>
                    </div>
                    <?= $content ?>
                </div>
                <!-- end container -->
            </div>
            <!-- end content -->

            <footer class="footer text-right">
                2016 © Minton.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
        
    </div>
    
    <div id="modulo-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            
            <?php if(isset($this->params['grupo'])){
                    if($this->params['grupo'] > 0){ ?>
                        <div class="ribbon" style="left: -7px;top: -9px;">
                            <span style="line-height:25px;background:linear-gradient(<?= $this->params['grupo-model']->grupo_color;?> 0%, <?= $this->params['grupo-model']->grupo_color;?> 100%)"><?= $this->params['grupo-model']->grupo_nombre;?></span>
                        </div>
                    <?php }
                }
            ?>
                
            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nuevo</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    
    <div id="grupo-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Grupo Nuevo</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


<?php
//$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
   
<?php
$grupo = 0;

if(isset($this->params['grupo'])){
    if($this->params['grupo'] > 0){
        $grupo = $this->params['grupo'];
    }
}

$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/loadmodulo','grupo'=>$grupo]));
$urlFormGrupo  = \yii\helpers\Json::htmlEncode(Url::to(['grupo/create']));
$this->registerJs(<<<JS

        $("li.modulo").on('click',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data:{mod_id:id},
                error:function(){
                    $.Notification.notify("error","right-bottom","Crear Modulo","Algo ocurrio al crear modulo.");
                },
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
        
        $("li#create-grupo").on('click',function(e){
            e.preventDefault();
            $.ajax({
                url: $urlFormGrupo,
                type:'post',
                dataType:'json',
                error:function(){
                    $.Notification.notify("error","right-bottom","Crear Grupo","Algo ocurrio al crear grupo.");
                },
                beforeSend:function(){
                   $("#grupo-modal").modal("toggle");
                },
                success:function(resp){
                   $("#grupo-modal .modal-body").html(resp.div);
                },complete:function(jqXHR, textStatus){
        
                }
            });
            
            return false;
        });
        
JS
   );
    
?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
