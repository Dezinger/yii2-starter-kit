<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;

class PageController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Page';

}