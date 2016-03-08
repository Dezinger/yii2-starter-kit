<?php

use yii\filters\ContentNegotiator;
use yii\web\Response;

return [
    'id' => 'api',
    'basePath'=>dirname(__DIR__),
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
    ],
    
    'bootstrap' => [
        [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ]
        ],
    ]
];
