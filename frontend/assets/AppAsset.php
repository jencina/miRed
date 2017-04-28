<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'page-theme/css/font-awesome.min.css',
        'page-theme/css/agency.min.css',
        'page-theme/css/site.css',
    ];
    public $js = [
        'page-theme/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
        'page-theme/js/jqBootstrapValidation.js',
        'page-theme/js/contact_me.js',
        'page-theme/js/agency.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
