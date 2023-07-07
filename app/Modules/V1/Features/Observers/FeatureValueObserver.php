<?php
namespace App\Modules\V1\Features\Observers;

use App\Modules\V1\Features\Models\FeatureValue;
use Illuminate\Support\Str;

class FeatureValueObserver
{
    /*
    **
     * Handle the FeatureValue "created" event.
     *
     * @param  \App\Models\FeatureValue  $FeatureValue
     * @return void
     */
    public function creating(FeatureValue $page)
    {
        $value = $page->slug;
        $slug = Str::slug($value);
        $temp = $page::whereLike('slug',$slug)->count();
        if ($temp>0) {
            $this->attributes['slug'] = $slug;   
            $original = $slug;
            if($temp>0){
                $slug = "{$original}-" . $temp;
            }
            $page->slug = $slug;
        }

    }

    /**
     * Handle the FeatureValue "updated" event.
     *
     * @param  \App\Models\FeatureValue  $FeatureValue
     * @return void
     */
    public function updating(FeatureValue $page)
    {

        $value = $page->slug;
        //check slug against id is same or not
        $id_slug = FeatureValue::find($page->id);
        //counting
        $slug = Str::slug($value);
        $this->attributes['slug'] = $slug;   
        $temp_count = $page::whereLike('slug',$slug)->count();
        if($id_slug->slug != $value && $temp_count>0){
            $original = $slug;
            if($temp_count>0){
                $slug = "{$original}-" . $temp_count;
            }
            $page->slug = $slug;
        }
    }

    /**
     * Handle the FeatureValue "deleted" event.
     *
     * @param  \App\Models\FeatureValue  $FeatureValue
     * @return void
     */
    public function deleted(FeatureValue $page)
    {
        //
    }

    /**
     * Handle the FeatureValue "forceDeleted" event.
     *
     * @param  \App\Models\FeatureValue  $FeatureValue
     * @return void
     */
    public function forceDeleted(FeatureValue $page)
    {
        //
    }
}