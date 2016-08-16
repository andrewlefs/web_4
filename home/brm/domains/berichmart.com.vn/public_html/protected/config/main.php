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
                'ext.yii-mail.YiiMailMessage',
                'ext.yii-mail.YiiMail',
                'ext.php-mailer.PHPMailer',
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
                'service',
		
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
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\w+>/<id2:\w+>'=>'<module>/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view', // cac khai bao url mặc định dạng : ten controller / ten action / ten tham số / giá trị tham số
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>/<product_id:\d+>/<member_id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                'danh-sach-danh-muc'=>array('category/index','caseSensitive'=>false), // tự rewrite url ,caseSensitive khai bao không phân biệt chữ hoa chữ thư�?ng
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
                                'xoa-gio-hang'=>array('home/products/deleteAll','caseSensitive'=>false),
                                'rao-vat-member-<id:\d+>/*'=>array('home/adNews/listbymember','caseSensitive'=>false),
                                'rao-vat-cat-<id:\d+>/*'=>array('home/adNews/list','caseSensitive'=>false),
                                'rao-vat-search-<id:\d+>/*'=>array('home/adNews/search','caseSensitive'=>false),
                                'rao-vat-<id:\d+>/*'=>array('home/adNews/view','caseSensitive'=>false),
                                'rao-vat'=>array('home/adNews/list','caseSensitive'=>false),
                                'tin-tuc'=>array('home/news/index','caseSensitive'=>false),
                                'tin-tuc-<id:\d+>/*'=>array('home/news/view','caseSensitive'=>false),
                                'tin-tuc-cat-<id:\d+>/*'=>array('home/news/list','caseSensitive'=>false),
                                'tin-tuc-view-<id:\d+>/*'=>array('home/news/viewCategory','caseSensitive'=>false),
                                'lien-he'=>array('home/news/viewCategory','defaultParams'=>array('id'=>408),'caseSensitive'=>false),
                                'gioi-thieu'=>array('home/news/viewCategory','defaultParams'=>array('id'=>391),'caseSensitive'=>false),                                
                                'dang-xuat'=>array('home/members/logout','caseSensitive'=>false),
                                'thong-tin-tai-khoan'=>array('member/default/memberinfo','caseSensitive'=>false),
                                'doanh-thu-hoa-hong'=>array('member/default/rose','caseSensitive'=>false),
                                'nang-cap'=>array('member/default/updateTVCT','caseSensitive'=>false),
                                'hoa-hong-thu-dong'=>array('member/default/roseBuying','caseSensitive'=>false),
                                'hoa-hong-ho-tro-phat-trien-he-thong'=>array('member/default/roseOffline','caseSensitive'=>false),
                                'hoa-hong-phat-trien-he-thong'=>array('member/default/roseOnline','caseSensitive'=>false),
                                'doan-so-tieu-dung'=>array('member/default/detailBuying','caseSensitive'=>false),
                                'lich-su-hoa-hong'=>array('member/default/history','caseSensitive'=>false),
                                'tim-kiem-thanh-vien'=>array('member/default/searchMember','caseSensitive'=>false),
                                'hop-tac'=>array('home/news/cooperation','caseSensitive'=>false),
                                'gioi-thieu'=>array('home/news/cooperation','caseSensitive'=>false),
                                'hop-tac-<id:\d+>/*'=>array('home/news/cooperation','caseSensitive'=>false),
                                'account'=>array('admin/adminMembers/','caseSensitive'=>false),
                                'tuyen-dung'=>array('home/news/list','defaultParams'=>array('id'=>407),'caseSensitive'=>false),
                                'them-diem'=>array('admin/adminMembers/addDiem','caseSensitive'=>false),
			),
		),
            
                // cau hinh dung extension email
                'mail' => array(
                    'class' => 'ext.yii-mail.YiiMail',
                ),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=brm_berichmart',
			'emulatePrepare' => true,
			'username' => 'brm_berichmart',
			'password' => 'berichmart',
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
            'tree'=>array(
                'class'=>'TreeMember',                
            )
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
             
                
	),
     
);
