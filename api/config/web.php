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
                Response::FORMAT_XML => 'common\components\formatters\XmlCDATAResponseFormatter'
            ]
        ],
        
        'request' => [
            'cookieValidationKey' => getenv('FRONTEND_COOKIE_VALIDATION_KEY')
            //'enableCookieValidation' => false
        ],
        
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            //'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => false,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ]
    ],
    
    'as locale' => [
        'class' => 'common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ]
];


return $config;
