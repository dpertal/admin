<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$theme = 'luckybuys';
$program = 3;
$frontend = dirname(dirname(__FILE__));


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CRG.',
    'defaultController' => 'site',
	'preload'=>array('log'),
    'theme'=>$theme,
    'controllerPath' => $frontend . '/controllers',
    'viewPath' => dirname($frontend) . DIRECTORY_SEPARATOR . 'themes/' . $theme . '/views',
    'runtimePath' => $frontend . '/runtime',
        
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.models.*',
		'application.components.*',
		'ext.yii-mail.YiiMailMessage',
        'ext.ECompositeUniqueValidator',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'555',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
            'class' => 'WebUser',
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'mail' => array(
				'class' => 'ext.yii-mail.YiiMail',
				'transportType' => 'php', // change to 'php' when running in real domain.
				'viewPath' => 'application.views.mail',
				'logging' => true,
				'dryRun' => false,
				/*'transportOptions' => array(
						'host' => 'smtp.example.com',
						'username' => 'myuser',
						'password' => 'mypass',
						'port' => '465',
						'encryption' => 'tls',
				),*/
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
               
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		//live
		
		 'db'=>array(
		 		'connectionString' => 'mysql:host=localhost;dbname=crgtesti_db',
		 		'emulatePrepare' => true,
		 		'username' => 'crgtesti_user',
		 		'password' => 'Passme@14',
		 		'charset' => 'utf8',
		 ),

         'db'=>array(
             'connectionString' => 'mysql:host=localhost;dbname=cashrewardsweb_local',
             'emulatePrepare' => true,
             'username' => 'root',
             'password' => '',
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
		'adminEmail'=>'info@crg.com.au',
                'program' => $program,
	),
	
);