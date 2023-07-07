<?php

namespace App\Modules\V1\Categories;

use App\Modules\V1\Categories\Models\Category;

class CategoryModuleExports 
{
   public static function getCategoryObject()
    {
        $cat = new Category;
        return ($cat);
    }
}
