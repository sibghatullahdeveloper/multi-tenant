<?php
namespace App\Modules\V1\Categories\Services;

use App\Modules\V1\Categories\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
   function addCategory($request = [])
   {
       $check =  Category::create([
            'id' => Str::uuid(),  
            'title' => $request['title'], 
            'description' => $request['description'],  
            'created_by_id' => \Auth::id(),
            'category_id' => $request['parent'] ?? null
        ]);   

        if($check){
            return true;
        }
   }

   function deleteCategory($id)
   {
       $parent = Category::find($id);
       if($parent){
        $parent->children()->delete();
        $parent->delete();
        return sendInternalSuccess('Category Deleted Successfully');
       }else{
        return sendInternalError("Please Choose Valid Category");
       }

   }

   function getCategoryById($id)
   {
     $parent = Category::where('id',$id)->first(['title','description','id']);
     return $parent; 
   }


   function updateCategory($request = [])
   {
        $cat = Category::where('id',$request['parent'])->first();
       if($cat){
           $cat->update([
               'title' => $request['title'],
               'description' => $request['description'],
           ]);
           return sendInternalSuccess('Category Updated Successfully');
       }else{
       return sendInternalError("Please Choose Valid Category");
       }
   }
}