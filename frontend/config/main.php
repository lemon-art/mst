<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'language' => 'ru-RU',
	'modules' => [
		'gii' => [
            'class' => 'yii\gii\Module', //adding gii module
            'allowedIPs' => ['*']  //allowing ip's 
        ],
		'user' => [
			'class' => 'dektrium\user\Module',
			
		],
	],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'enableStrictParsing' => false,
            'rules' => [
                '' => 'site/index',
				'<module:gii>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'services/<code>' => 'services/view',
				'specoffers' => 'services/specindex',
				'specoffers/<code>' => 'services/specoffers',
				'banks/<code>' => 'banks/view',
				'orders/validate' => 'orders/validate',
				'articles' => 'atricles/index',
				'articles/<id>' => 'atricles/view',
				'reviews' => 'reviews/index',
				'reviews/<id>' => 'reviews/view',
				'personal' => 'site/personal',
				'<action:(.*)>' => 'site/pages',
            ],
        ],
		'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],  
        'request' => [
            'baseUrl' => ''
        ]
    ],
    'params' => $params,
];
