<?php

namespace App\Modules\V1\Features;

use App\Modules\V1\Features\Models\Feature;
use App\Modules\V1\Features\Models\FeatureValue;


class FeatureModuleExports 
{
   public static function getFeatureObject()
    {
        $fea = new Feature();
        return ($fea);
    }

    public static function getFeatureValueObject()
    {
    	$fv = new FeatureValue();
    	return $fv;
    }


}
