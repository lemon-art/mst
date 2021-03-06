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
        'css/styles.css',
		'css/jquery.fancybox.css',
		'css/owl.carousel.css',
		'css/steps.css',
    ];
    public $js = [
	'js/jquery-migrate-1.4.1.min.js',
	'js/maskedinput.min.js',
	'js/nice-select.js',
	'js/jquery.fancybox.min.js',
	'js/owl.carousel.min.js',
	'js/jquery.validate.min.js',
	'js/additional-methods.min.js',
	'js/jquery.steps.min.js',
	'js/scripts.js'
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
