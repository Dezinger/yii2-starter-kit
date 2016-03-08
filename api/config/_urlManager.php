<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'rules'=> [
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/page', 'only' => ['index'/*, 'view'*/]],
    ]
];
