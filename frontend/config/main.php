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
    "bootstrap" => ["log", "languagepicker"],
    'language' => 'uz',
    'controllerNamespace' => 'frontend\controllers',


    'modules' => [
        'sanakulov' => [
            'class' => 'mdm\admin\Module',






            'layout' => 'left-menu',
//            'mainLayout' => '@mdm/admin/views/layouts/main.php',
//            'menus' => [
//                'assignment' => [
//                    'label' => 'Grant Access' // change label
//                ],
//                'route' => null, // disable menu
//            ],



        ],
    ],


    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
            'rules' => [
                // your rules go here
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' =>  __DIR__.DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'common/messages',
                ],


            ],
        ],


        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'port' => '587',
                'encryption' => 'tls',
                'username' => 'murodsanakulov52@gmail.com',
                'password' => 'rtpgjcdygszhsfnq',
            ],
        ],


        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            // List of available languages (icons and text)
            'languages' => [
                'en' => 'English',
                'uz' => 'Uzbek',
                'ru' => 'Russian',
                'cyrl'=>"Ўзбекча"
                ]
        ]
    ],


    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'sanakulov/*',
            'ajax/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],


    'params' => $params,
];
