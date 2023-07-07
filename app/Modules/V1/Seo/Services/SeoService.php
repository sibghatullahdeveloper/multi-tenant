<?php
namespace App\Modules\V1\Seo\Services;

use App\Modules\V1\Seo\Models\Seo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SeoService
{
  function store($request=[])
  {
    $p=parse_url($request['url']);
    if(isset($p['host'])){
      $temp = Auth::user()->role->slug;
      $url = (str_replace('/'.$temp.'/',"",$p['path']));
    }else{
      $url = $p['path'];
    }
    $check = Seo::create([
      'id' => Str::uuid(), 
      'title' => $request['title'], 
      'url' => $url, 
      'meta_keywords' => $request['keywords'], 
      'meta_description' => $request['description'],
      'created_by_id' => Auth::id(),  
    ]);

    if($check){
      sendInternalSuccess('SEO Content Added Successfully');
    }else{
      sendInternalError("Seo Not Added");
    }
  }

  function get($id = "")
  {
      if($id == ""){    
        return Seo::all();
      }else{
        return Seo::where('id',$id)->first();
      }
  }

  function update($request = [])
  {
    $p=parse_url($request['url']);
    if(isset($p['host'])){
      $url = (str_replace('/'.Auth::user()->role->slug.'/',"",$p['path']));
    }else{
      $url = $p['path'];
    }
    $seo = Seo::find($request['id']);
    if($seo->url == $request['url'] ){
      $seo->update([
        'title' => $request['title'], 
        'meta_keywords' => $request['keywords'], 
        'meta_description' => $request['description'], 
        'created_by_id' => Auth::id(), 
      ]);
      return sendInternalSuccess("Seo Content Updated");
    }else{
      $check_new_exist = Seo::where('url',$url)->first();
      if($check_new_exist){
        return sendInternalError('Url Already Exists');
      }else{
        $seo->update([
            'title' => $request['title'],
            'url' => $request['url'], 
            'meta_keywords' => $request['keywords'], 
            'meta_description' => $request['description'],
            'created_by_id' => Auth::id(), 
        ]);
        return sendInternalSuccess("Seo Content Updated");
      }
    }
    
      return sendInternalError("Seo Content Not Updated");
  }


  function delete($request = [])
  {
    $seo = Seo::find($request['id']);
    if($seo){
      $seo->delete();
    }else{
      return sendInternalError("No Page Found Against Id");
    }
  }
}