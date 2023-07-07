<?php
namespace App\Modules\V1\Features\Services;


use App\Modules\V1\Features\Models\FeatureValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FeatureValueService
{
  function store($request = [],$id = "")
  {
    if($id != ""){
        $check =  FeatureValue::where('id',$id);
        if($check){
            $check->update([  
                'title' => $request['title'], 
                'description' => $request['description'],  
                'slug' => Str::slug($request['title']),
                'sort_order' => $request['sort_order'],
            ]);       
            return true;
        }else{
            return false;
        }
    }else{
      // dd($request);
        $check =  FeatureValue::create([
            'id' => Str::uuid(),    
            'created_by_id' => Auth::id(),
            'title' => $request['title'], 
            'description' => $request['description'],  
            'slug' => Str::slug($request['title']),
            'sort_order' => $request['sort_order'],
            'feature_id' => $request['feature_id'],
        ]);   

        if($check){
            return true;
        }else{
            return false;
        }
    }
  }


  function get($id='')
  {
    if($id == ""){    
        return FeatureValue::all();
      }else{
        return FeatureValue::where('feature_id',$id)->get();
      }
  }

  function getByUUID($id)
  {
    return FeatureValue::where('id',$id)->first();  
  }

  function delete($request = [])
  {
    $seo = FeatureValue::find($request['id']);
    if($seo){
      $seo->delete();
    }else{
      return sendInternalError("No Feature Found Against Id");
    }
  }
}