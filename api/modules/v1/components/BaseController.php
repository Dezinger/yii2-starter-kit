<?php

namespace api\modules\v1\components;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class BaseController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
}