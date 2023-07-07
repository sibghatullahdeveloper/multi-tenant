<?php
namespace App\Modules\V1\Seo\Observers;

use App\Modules\V1\Seo\Models\Seo;
use Illuminate\Support\Str;

class SeoObserver
{
    /*
    **
     * Handle the Seo "created" event.
     *
     * @param  \App\Models\Seo  $Seo
     * @return void
     */
    public function creating(Seo $seo)
    {
        $value = $seo->slug;
        $slug = Str::slug($value);
        $temp = $seo::whereLike('slug',$slug)->count();
        if ($temp>0) {
            $this->attributes['slug'] = $slug;   
            $original = $slug;
            if($temp>0){
                $slug = "{$original}-" . $temp;
            }
            $seo->slug = $slug;
        }

    }

    /**
     * Handle the Seo "updated" event.
     *
     * @param  \App\Models\Seo  $Seo
     * @return void
     */
    public function updating(Seo $seo)
    {

        $value = $seo->slug;
        //check slug against id is same or not
        $id_slug = Seo::find($seo->id);
        //counting
        $slug = Str::slug($value);
        $this->attributes['slug'] = $slug;   
        $temp_count = $seo::whereLike('slug',$slug)->count();
        if($id_slug->slug != $value && $temp_count>0){
            $original = $slug;
            if($temp_count>0){
                $slug = "{$original}-" . $temp_count;
            }
            $seo->slug = $slug;
        }
    }

    /**
     * Handle the Seo "deleted" event.
     *
     * @param  \App\Models\Seo  $Seo
     * @return void
     */
    public function deleted(Seo $seo)
    {
        //
    }

    /**
     * Handle the Seo "forceDeleted" event.
     *
     * @param  \App\Models\Seo  $Seo
     * @return void
     */
    public function forceDeleted(Seo $seo)
    {
        //
    }
}