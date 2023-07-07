<?php
namespace App\Modules\V1\Features\Services;

use App\Modules\V1\Categories\CategoryModuleExports;
use App\Modules\V1\Features\Models\Feature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FeatureService
{
  function store($request = [],$id = "")
  {
    if($id != ""){
        $check =  Feature::where('id',$id);
        if($check){
            $check->update([  
                'title' => $request['title'], 
                'description' => $request['description'],  
                'display_type' => $request['display_type'], 
                'sort_order' => $request['sort_order'],
                'categories_id' => ($request['category']),  
            ]);       
            return true;
        }else{
            return false;
        }
    }else{
      // dd($request);
        $check =  Feature::create([
            'id' => Str::uuid(),  
            'title' => $request['title'], 
            'description' => $request['description'],  
            'created_by_id' => Auth::id(),
            'display_type' => $request['display_type'], 
            'sort_order' => $request['sort_order'],
            'categories_id' => ($request['category']), 
        ]);   

        if($check){
            return true;
        }else{
            return false;
        }
    }
  }


  function get($id='', $withCategoryLoop=false)
  {
    if($id == "" && $withCategoryLoop == false){    
        $features = Feature::all();
        return $features;
      }else if($id != "" && $withCategoryLoop == false){
        return Feature::where('id',$id)->first();
      }else{
        $temp = Feature::all();
        $data = [];
        foreach ($temp as $key => $value) {
          if(is_array($value['categories_id'])){
            $value['categories'] = CategoryModuleExports::getCategoryObject()->whereIn('id',$value['categories_id'])->get();
          }
          $data[] = $value;
        }
        return ($data);
      }
  }

  function delete($request = [])
  {
    $seo = Feature::find($request['id']);
    if($seo){
      $seo->delete();
    }else{
      return sendInternalError("No Page Found Against Id");
    }
  }


  function getCategoriesById($catAtt = [])
  {
    return CategoryModuleExports::getCategoryObject()->whereIn('id',$catAtt)->get();
  }
}