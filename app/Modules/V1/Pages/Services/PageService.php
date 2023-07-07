<?php
namespace App\Modules\V1\Pages\Services;

use App\Modules\V1\Pages\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageService
{
  function store($request=[])
  {
    $content = $request['content'];
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $imageFile = $dom->getElementsByTagName('img');
    
    foreach($imageFile as $item => $image){
        $data = $image->getAttribute('src');

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $imgeData = base64_decode($data);
        $image_name= "/pages/" . time().$item.'.png';
        $path = public_path() . $image_name;
        file_put_contents($path, $imgeData);
        
        $image->removeAttribute('src');
        $image->setAttribute('src', $image_name);
     }
    $content = $dom->saveHTML();

    if($content){
        Page::create([
            'id' => Str::uuid(), 
            'title' => $request['title'], 
            'slug' => Str::slug($request['title']), 
            'content' => $content, 
            'created_by_id' => \Auth::id(), 
        ]);
    }else{
        sendInternalError("Plese Enter Some Contents");
    }
  }

  function get($id = "")
  {
      if($id == ""){    
        return Page::all();
      }else{
        return Page::where('id',$id)->first();
      }
  }

  function update($request = [])
  {
    $content = $request['content'];
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $imageFile = $dom->getElementsByTagName('img');
    
    foreach($imageFile as $item => $image){
        $data = $image->getAttribute('src');

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $imgeData = base64_decode($data);
        $image_name= "/pages/" . time().$item.'.png';
        $path = public_path() . $image_name;
        file_put_contents($path, $imgeData);
        
        $image->removeAttribute('src');
        $image->setAttribute('src', $image_name);
     }
    $content = $dom->saveHTML();

    if($content){
        $page = Page::find($request['id']);
        if($page->title == $request['title'] ){
          $page->update([
            'title' => $request['title'],  
            'content' => $content, 
            'created_by_id' => Auth::id(), 
          ]);
        }else{
          $page->update([
              'title' => $request['title'],
              'slug' => Str::slug($request['title']),
              'content' => $content, 
              'created_by_id' => Auth::id(), 
          ]);
        }
    }else{
        sendInternalError("Plese Enter Some Contents");
    }
  }

  function delete($request = [])
  {
    $page = Page::find($request['id']);
    if($page){
      $page->delete();
    }else{
      return sendInternalError("No Page Found Against Id");
    }
  }
}