<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'plugins/jquery-circliful/css/jquery.circliful.css',
        'admin-theme/css/bootstrap.min.css',
        'admin-theme/css/core.css',
        'admin-theme/css/components.css',
        'admin-theme/css/icons.css',
        'admin-theme/css/pages.css',
        'admin-theme/css/menu.css',
        'admin-theme/css/responsive.css',
    ];
    
    public $js = [
        //'js/theme/jquery.min.js',
        'js/theme/bootstrap.min.js',
        'admin-theme/js/bootstrap.min.js',
        'admin-theme/js/detect.js',
        'admin-theme/js/fastclick.js',
        'admin-theme/js/jquery.slimscroll.js',
        'admin-theme/js/jquery.blockUI.js',
        'admin-theme/js/waves.js',
        'admin-theme/js/wow.min.js',
        'admin-theme/js/jquery.nicescroll.js',
        'admin-theme/js/jquery.scrollTo.min.js',
        'plugins/switchery/switchery.min.js',
        
        //'plugins/waypoints/lib/jquery.waypoints.js',
        //'plugins/counterup/jquery.counterup.min.js',
                
        //'plugins/pages/jquery.dashboard.js',
        'admin-theme/js/jquery.core.js',
        //'admin-theme/js/jquery.app.js',
        'admin-theme/js/main.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
