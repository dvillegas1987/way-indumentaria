<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [ 'gridview' => [ 'class' => '\kartik\grid\Module' ] ],
    'defaultRoute' => 'site/login',
    'components' => [
        'unificacion' => [
            'class' => 'app\components\UnificacionComponent',
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => ['lifetime' => false]
       ],
       'formatter' => [
        'class' => 'yii\i18n\formatter',
        'thousandSeparator' => ' ',
        'decimalSeparator' => '.',
    ],

	    'assetManager' => [
	        'bundles' => [
	            'dosamigos\google\maps\MapAsset' => [
	                'options' => [
	                    'key' => 'AIzaSyCaWlSjIfXuMDJ6R_kcuzIALU2Mj9nX7qg',
	                    //'language' => 'id',
	                    'version' => '3.1.18'
	                ]
	            ]
	        ]
	    ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BzHS6i3TFMuKCdPn_ehBd0eAqxpAmGrb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

            'useFileTransport' => false,
                    // send all mails to a file by default. You have to set
                    // 'useFileTransport' to false and configure a transport
                    // for the mailer to send real emails.
            'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.webfaction.com',
                    'username' => 'tt_jpceleste',
                    'password' => 'ludkia84',
                    'port' => '465',
                    'encryption' => 'ssl',
            ],
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
        'db' => require(__DIR__ . '/db.php'),

        'formatter' => [
           'defaultTimeZone' => 'UTC',
           'timeZone' => 'America/Argentina/Buenos_Aires',
           //'dateFormat' => 'php:d-m-Y',
           //'datetimeFormat'=>'php:d-m-Y H:i:s'
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

        
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],
    'params' => $params,
    'language' => 'es',
    //'defaultTimeZone' => 'UTC',
    //'timeZone' => 'America/Argentina/Buenos_Aires',


];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
