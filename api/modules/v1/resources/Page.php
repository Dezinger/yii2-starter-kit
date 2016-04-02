<?php

namespace api\modules\v1\resources;

use common\models\Page AS Pages;
use common\components\formatters\XmlCDATAResponseFormatter;

class Page extends Pages
{
    
    public function fields() 
    {
        return [
            'id', 
            'slug', 
            'title', 
            'body' => function() {
                return [$this->body, XmlCDATAResponseFormatter::CDATA => true];
            }
        ];
    }
    
}