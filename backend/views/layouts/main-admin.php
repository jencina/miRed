<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AdminAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

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
    
    <div id="wrapper">
        
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
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group nicescroll notification-list">
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-diamond noti-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new
                                                            order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-cog noti-warning"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-bell-o noti-success"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Updates</h5>
                                                        <p class="m-0">
                                                            <small>There are <span class="text-primary">2</span> new
                                                                updates available
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

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
                                $menu[] = ['label' => '<span><i class="fa fa-circle-o text-'.$mod->mod_color.'"></i> '.Yii::t('app', $mod->mod_nombre).'</span>','icon'=>'fa-home','options'=> ['id'=>'create-modulo'.$mod->mod_id,'data-id'=>$mod->mod_id,'class'=>'has-sub modulo'], 'linkTemplate'=>'<a href="{url}">aa{label}</a>', 'url' => "#modulo-modal"];
                            }
                            
                            //********** GRUPOS *************
                            $menu[] = ['label'=>'GRUPOS','options'=> ['class'=>'menu-title']];
                            
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
                                <h5 class="m-t-0 m-b-0">John Deo</h5>
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
        <div class="content-page">
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


<?php
$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web') . '/plugins/custombox/dist/legacy.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web') . '/plugins/custombox/dist/custombox.min.css', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
   
<?php

$urlFormModulo  = \yii\helpers\Json::htmlEncode(Url::to(['modulo/loadmodulo']));
$this->registerJs(<<<JS

        $("li.modulo").on('click',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: $urlFormModulo,
                type:'post',
                dataType:'json',
                data:{mod_id:id},
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
        
JS
   );
    
?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
