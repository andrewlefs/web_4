<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'defaultController'=>'home',  // khai bao ten controller hoac ten module default
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'thanh',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'admin',
                'member',
                'home',
		
	),

	// application components
    
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        //'loginUrl'=>array('login/index'), // url login
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false, //ân index.php
			'rules'=>array(                                
                                '<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<product_id:\d+>/<member_id:\d+>'=>'<module>/<controller>/<action>',                                
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/<style:\d+>'=>'<module>/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view', // cac khai bao url mặc định dạng : ten controller / ten action / ten tham số / giá trị tham số
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>/<product_id:\d+>/<member_id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                'danh-sach-danh-muc'=>array('category/index','caseSensitive'=>false), // tự rewrite url ,caseSensitive khai bao không phân biệt chữ hoa chữ thường
                                'chi-tiet-danh-muc-<id:\d+>/*'=>array('category/view','caseSensitive'=>false), //vd : chi-tiet-danh-muc-id/ten.html
                                // 'urlSuffix'=>'.xml' them duoi vao url neu can
                               // 'admin'=>array('admin/admin/index','caseSensitive'=>false),
                                //'member'=>array('member','caseSensitive'=>false),
                                'catl-<id:\d+>/*'=>array('home/products/listlast2','caseSensitive'=>false),
                                'cat-<id:\d+>/*'=>array('home/products/list','caseSensitive'=>false),
                                'view-<id:\d+>/*'=>array('home/products/view','caseSensitive'=>false),
                                'dang-nhap'=>array('home/members/login','caseSensitive'=>false),
                                'dang-ky'=>array('home/members/register','caseSensitive'=>false),
                                'add-<id:\d+>/*'=>array('home/products/addshoppingcart','caseSensitive'=>false),
                                'delete-<id:\d+>/*'=>array('home/products/deleteshoppingcart','caseSensitive'=>false),
                                'gio-hang'=>array('home/products/viewshoppingcart','caseSensitive'=>false),
                                'xoa-gio-hang'=>array('home/products/DeleteAllshoppingcart','caseSensitive'=>false),
                                'rao-vat-member-<id:\d+>/*'=>array('home/adNews/listbymember','caseSensitive'=>false),
                                'rao-vat-cat-<id:\d+>/*'=>array('home/adNews/list','caseSensitive'=>false),
                                'rao-vat-search-<id:\d+>/*'=>array('home/adNews/search','caseSensitive'=>false),
                                'rao-vat-<id:\d+>/*'=>array('home/adNews/view','caseSensitive'=>false),
                                'rao-vat'=>array('home/adNews/list','caseSensitive'=>false),
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=berichmart_yii',
			'emulatePrepare' => true,
			'username' => 'berichmart',
			'password' => 'hlE6Ag4F',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
             
                
	),
     
);
