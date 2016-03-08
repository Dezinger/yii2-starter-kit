<?php

use yii\web\Response;

$config = [
    'homeUrl' => Yii::getAlias('@apiUrl'),

    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ]
    ],
    
    
    'components' => [
        
        'response' => [
            'formatters' => [
                //Formats the given data into an XML response content with CDATA support.
                Response::FORMAT_XML => 'common\components\XmlCDATAResponseFormatter'
            ]
        ],
        
        'request' => [
            'cookieValidationKey' => getenv('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            //'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => false,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ]
    ],
];


if (YII_ENV_PROD) {
    // Maintenance mode
    $config['bootstrap'] = ['maintenance'];
    $config['components']['maintenance'] = [
        'class' => 'common\components\maintenance\Maintenance',
        'enabled' => function ($app) {
            return $app->keyStorage->get('frontend.maintenance') === 'enabled';
        }
    ];
}

return $config;
