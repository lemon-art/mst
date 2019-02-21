<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'controllerMap' => [
		'elfinder' => [
			'class' => 'mihaildev\elfinder\PathController',
			'access' => ['@'],
			 'plugin' => [
                [
                    'class'=>'mihaildev\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
            ],
			'root' => [
				'baseUrl'=>'',
                'basePath'=>'@frontend/web',
				'path' => '/upload',
				'name' => 'Files'
			],
		]
	],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'formatter' => [
               'class' => 'yii\i18n\Formatter',
               'defaultTimeZone' => 'Europe/Moscow',
               'dateFormat' => 'd MMMM yyyy',
               'datetimeFormat' => 'd-M-Y H:i:s',
               'timeFormat' => 'H:i:s', 
        ],
    ],
];
