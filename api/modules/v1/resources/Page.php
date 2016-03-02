<?php

namespace api\modules\v1\resources;

use common\models\Page AS Pages;

class Page extends Pages
{
    
    public function fields() 
    {
        return ['id', 'slug', 'title', 'body'];
    }
}