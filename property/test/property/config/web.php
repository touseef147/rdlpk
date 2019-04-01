<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'development' => [
            'class' => 'app\modules\development\development',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\development\reports\reports',
                ],
            ],
        ],
        'documents' => [
            'class' => 'app\modules\documents\documents',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\documents\reports\reports',
                ],
            ],
        ],
        'security' => [
            'class' => 'app\modules\security\security',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\security\reports\reports',
                ],
            ],
        ],
        'marketting' => [
            'class' => 'app\modules\marketting\marketting',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\marketting\reports\reports',
                ],
                'visitors' => [
                    'class' => 'app\modules\marketting\visitors\visitors',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\marketting\visitors\reports\reports',
                        ],
                    ],
                ],
            ],
        ],
        /*
         * moved to marketting module
         *         'visits' => [
          'class' => 'app\modules\visits\visits',
          'modules' => [
          'reports' => [
          'class' => 'app\modules\visits\reports\reports',
          ],
          ],
          ],
         * 
         */
        'general' => [
            'class' => 'app\modules\general\general',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\general\reports\reports',
                ],
            ],
        ],
        /*
         * moved to property/config       
         * 'propertyconfig' => [
          'class' => 'app\modules\propertyconfig\propertyconfig',
          'modules' => [
          'reports' => [
          'class' => 'app\modules\propertyconfig\reports\reports',
          ],
          ],
          ], */
        'property' => [
            'class' => 'app\modules\property\property',
            'modules' => [
                'application' => [
                    'class' => 'app\modules\property\application\application',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\property\application\reports\reports',
                        ],
                    ],
                ],
                'config' => [
                    'class' => 'app\modules\property\config\config',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\property\config\reports\reports',
                        ],
                    ],
                ],
                'membership' => [
                    'class' => 'app\modules\property\membership\membership',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\property\membership\reports\reports',
                        ],
                    ],
                ],
                'reports' => [
                    'class' => 'app\modules\property\reports\reports',
                ],
            ],
        ],
        'finance' => [
            'class' => 'app\modules\finance\finance',
            'modules' => [
                'forecast' => [
                    'class' => 'app\modules\finance\forecast\forecast',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\finance\forecast\reports\reports',
                        ],
                    ],
                ],
                'recovery' => [
                    'class' => 'app\modules\finance\recovery\recovery',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\finance\recovery\reports\reports',
                        ],
                    ],
                ],
                'reports' => [
                    'class' => 'app\modules\finance\reports\reports',
                ],
            ],
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\dashboard',
        ],
        'members' => [
            'class' => 'app\modules\members\members',
            'modules' => [
                'reports' => [
                    'class' => 'app\modules\members\reports\reports',
                ],
                'dealers' => [
                    'class' => 'app\modules\members\dealers\dealers',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\members\dealers\reports\reports',
                        ],
                    ],
                ],
                'portal' => [
                    'class' => 'app\modules\members\portal\portal',
                    'modules' => [
                        'reports' => [
                            'class' => 'app\modules\members\portal\reports\reports',
                        ],
                    ],
                ],
                'owners' => [
                    'class' => 'app\modules\members\owners\owners',
//                    'modules' => [
//                        'reports' => [
//                            'class' => 'app\modules\members\owners\reports\reports',
//                        ],
//                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'formatter' => [
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'Asia/Kolkata',
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:d-M-Y H:i:s'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rdlpk123',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'member' => [
            'identityClass' => 'app\models\Member',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//            'useFileTransport' => FALSE,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.rdlpk.com',
                'username' => 'inam@rdlpk.com',
                'password' => 'inam&&123',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LcDnDgUAAAAAHSxEV3SaaQaMjMi0CVXr5mpSc8p',
            //localhost : 6LcDnDgUAAAAAHSxEV3SaaQaMjMi0CVXr5mpSc8p
            //fdhl : 6LeTmzgUAAAAAE1nSR_88Ul1y8gEmjXRSGLE-XTw
            //rdl  : 6LcrqDgUAAAAAPH8HtJ3FFNFJQUatqxCZAQiCb-5
            'secret' => '6LcDnDgUAAAAAFxLYRhXcYPP6X4Y7GGjLU1LZ5J-',
            //localhost : 6LcDnDgUAAAAAFxLYRhXcYPP6X4Y7GGjLU1LZ5J-
            //fdhl : 6LeTmzgUAAAAAOnRcmfPorCFcGY9T0W3zjv184Ur
            //rdl  : 6LcrqDgUAAAAAF0pg55tP6lpHSetTSMS1GlB3hpJ
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
        /* 'urlManager' => [
          'class' => 'yii\web\UrlManager',
          // Disable index.php
          'showScriptName' => false,
          // Disable r= routes
          'enablePrettyUrl' => true,
          'rules' => array(
          '<controller:\w+>/<id:\d+>' => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
          ),
          ], */
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
