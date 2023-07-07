<?php
namespace App\Modules\V1\Pages\Observers;

use App\Modules\V1\Pages\Models\Page;
use Illuminate\Support\Str;

class PageObserver
{
    /*
    **
     * Handle the Page "created" event.
     *
     * @param  \App\Models\Page  $Page
     * @return void
     */
    public function creating(Page $page)
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
     * Handle the Page "updated" event.
     *
     * @param  \App\Models\Page  $Page
     * @return void
     */
    public function updating(Page $page)
    {

        $value = $page->slug;
        //check slug against id is same or not
        $id_slug = Page::find($page->id);
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
     * Handle the Page "deleted" event.
     *
     * @param  \App\Models\Page  $Page
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }

    /**
     * Handle the Page "forceDeleted" event.
     *
     * @param  \App\Models\Page  $Page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}