<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
        public $css = [
        'plugins/bootstrap-sweetalert/sweet-alert.css',
        'plugins/switchery/switchery.min.css',
        'plugins/jquery-circliful/css/jquery.circliful.css',
        'admin-theme/css/bootstrap.min.css',
        'admin-theme/css/core.css',
        'admin-theme/css/components.css',
        'admin-theme/css/icons.css',
        'admin-theme/css/pages.css',
        'admin-theme/css/menu.css',
        'admin-theme/css/responsive.css',
            'admin-theme/css/main.css',
    ];
        
    
    public $js = [
        //'admin-theme/js/jquery.min.js',
        'admin-theme/js/variables_top.js',
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
        
        //'plugins/custombox/dist/custombox.min.js',
        //'plugins/custombox/dist/legacy.min.js',
        
            
        'plugins/bootstrap-sweetalert/sweet-alert.min.js',
        //'plugins/waypoints/lib/jquery.waypoints.js',
        //'plugins/counterup/jquery.counterup.min.js',
                
        //'plugins/pages/jquery.dashboard.js',
        'admin-theme/js/jquery.core.js',
        'admin-theme/js/jquery.app.js',
        'admin-theme/js/main.js'
        
    ];
    
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
