<?php

return [
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'mvc' => PATH.DS.'mvc'.DS,
	'name'=>'Yii Blog Demo',

	// preloading 'log' component
	'preload'=>['log'],

        // autoloading model and component classes
	'import'=>array(
		//'application.models.*',
		'application.components.*',
	),
	
	'defaultController'=>'home', // post
        'components'=>[
            'urlManager'=>[
			'urlFormat'=>'path',
			'rules'=>[
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			],
		],
        ],

    
         // drupal
        'db' => [
            'main' => [
                'driver' => 'mysql',
                'database' => 'mvc',
                'username' => 'root',
                'password' => 'password',
                'host' => 'localhost',
                'prefix' => '',
            ],
            
            'secondary' => [
                'driver' => 'mysql',
                'database' => 'phones',
                'username' => 'root',
                'password' => 'password',
                'host' => 'localhost',
                'prefix' => '',
            ],
        ],
        
    
        // Settings 
        'Settings' => [
            'WebFolder' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
            'ClientType' => [
                             'admin' => [
                                 'loaderend' => '/',
                                 'delimiter' => '.',
                                 'DefaultVariable' => 'lang',
                                 'Variables' => ['OwnerID', 'lang']
                             ],
                             'front' => [
                                 'DefaultVariable' => 'SID',
                                 'Variables' => ['SID']
                             ]
                            ],
            'CookieName' => 'Lemberg',
            'CookieTimeout' => 18000,
            'OwnerID' => 'root',
            'DefaultOwner' => 'root',
            'Layout' => 'default',
            'DTR' => '_11_',
            'LDTR' => DIRECTORY_SEPARATOR,
            'lang' => 'ru',
            'GMT' => '+2',
            
            'RootPath' => PATH.DS.'mvc'.DS,
            'CacheStatus' => 'N',
            'GMT' => '+2',
            
            'CachePath' => 'cache/',
            'CacheCotrolType' => 'event',
            'CacheTime' => 24,
            
            'MaxFileSize' => 100000000,
            'HDDSpace' => 52428800,
            'ExtensionsOFF' => 'php,cgi,php4,php3,pl',
            'EditExtensions' => 'htm,html,txt,php,css,xml,xsl,thtml,js,css',
            'UseImageResize' => 'Y',
            'UseImagePreview' => 'Y',
            'UseImageIcon' => 'Y',
            'ImageWidthLimit' => 500,
            'ImageHeightLimit' => 1000,
            'ImageIconWidthLimit' => 60,
            'ImageIconHeightLimit' => 300,
            'ImagePreviwWidthLimit' => 240,
            'ImagePreviewHeightLimit' => 400,
            'MailEncoding' => 'iso-8859-2',
            'MailMode' => '',
            'MailSMTP' => 'localhost',
            'SiteMail' => 'test@com.com',
            
            
        ],
    
        // 'folders' => ['category' => 'category'],
        'ftp' => [
            'main'=>[
                'host'=>'ftp://localhost',
                'user'=>'annonimous',
                'password'=>'***',
                'path'=>'/',
            ]
        ],
    
        'mail' => [
            'mail_metod' => 'php',
            'admin_mail' => 'edii87shadow@gmail.com',
            'charset' => 'utf-8',
            'home_title' => 'Almira Trade company',
            'mail_additional' => '',
            'smtp_mail' => '',
            'smtp_host' => 'localhost',
            'smtp_port' => '25',
            'smtp_user' => '',
            'smtp_pass' => ''
        ],
    
        'captcha' => [
            'allow_recaptcha' => '0',
            'recaptcha_public_key' => '6LfoOroSAAAAAEg7PViyas0nRqCN9nIztKxWcDp_',
            'recaptcha_private_key' => '6LfoOroSAAAAAMgMr_BTRMZy20PFir0iGT2OQYZJ',
            'recaptcha_theme'=>'clean'
        ],

	'params'=>require(dirname(__FILE__).'/params.php')
];