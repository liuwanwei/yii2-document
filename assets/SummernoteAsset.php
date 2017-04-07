<?php

namespace bs\yii\document\assets;

use yii\web\AssetBundle;

class SummernoteAsset extends AssetBundle{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	// TODO: 使用相对于模块根目录的路径
	public $css = [
		'/js/sn/summernote.css',
		'//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css',
	];

	// TODO: 使用相对于模块根目录的路径
	public $js = [
		'/js/sn/summernote.min.js',
		'/js/sn/lang/summernote-zh-CN.js',
	];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\web\JqueryAsset',
	];
}