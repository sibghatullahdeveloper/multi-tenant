<?php

namespace App\Modules\V1\Product\Services;

use App\Modules\V1\Product\Models\Product;
use App\Modules\V1\Product\Models\ProductCombination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductService
{

   function storeSimpleProduct(Request $request)
   {

    //    dd($request);
       $combinationImages = [];
       if ($request->hasFile('image')) {
            $combinationImages = $this->getProductImagesArray($request);
        } 
        if($combinationImages != []){
            $checkProduct = Product::create([
                'id' => Str::uuid(),
                'title' => $request['title'], 
                'slug' => Str::slug($request->title), 
                'type' => 'single', 
                'total_quantity' => $request['quantity'], 
                'images_features' => json_encode($combinationImages), 
                'category_id' => $request['main_category'], 
                'sub_category_id' => $request['subcategory'],  
                'description' => $request['description'], 
                'has_value_price' => 0,
                'created_by_id' => Auth::id(), 
            ]);
            if($checkProduct){
                return sendInternalSuccess('Simple Product Added Successfully');
            }else{
                return sendInternalError("Product Not Added");
            }
        }else{
            return sendInternalError("Please Select A Valid Image Combination");
        }
   }
   function getProductImagesArray(Request $request)
   {

        //    dd($request);
        $combinationImages = [];
        if ($request->hasFile('image')) {
            $file = $request->image;
            $sizes = config('image_size');
            foreach ($sizes as $key => $size) {
                $filenamewithextension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename.'_'.uniqid().'-'.$size['width'].'x'.$size['height'].'.'.$extension;

                Storage::put('public/product_images/original_uploads'. $filenametostore, fopen($file, 'r+'));
                Storage::put('public/product_images/resize_product_image/'. $filenametostore, fopen($file, 'r+'));


                // For Crop
                // $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                //Resize image here
                $thumbnailpath = public_path('storage/product_images/resize_product_image/'.$filenametostore);
                $img = \Image::make($thumbnailpath)->resize($size['width'], $size['height']);
                $img->save($thumbnailpath);
                $combinationImages[] = [
                    $size['width'].'x'.$size['height'] => $thumbnailpath
                ];
            } 
            return ($combinationImages);      
        }
    }

   function storeVariableProduct(Request $request)
   { 
        $combinationImages = [];
        if ($request->hasFile('image')) {
             $combinationImages = $this->getProductImagesArray($request);
         } 
         if($combinationImages != []){
            $product_id = Str::uuid();   
            $checkProduct = Product::create([
                'id' => $product_id,
                'title' => $request['title'], 
                'slug' => Str::slug($request->title), 
                'type' => 'variable', 
                'total_quantity' => $request['quantity'], 
                'category_id' => $request['main_category'], 
                'sub_category_id' => $request['subcategory'],  
                'description' => $request['description'], 
                'has_value_price' => $request['feature_price_value'],
                'features' => json_encode($request['feature_selected']), 
                'created_by_id' => Auth::id(), 
            ]);
         
             if($checkProduct){
                 return sendInternalSuccess('Variable Product Added Successfully',['product_id' => $product_id,'feature_selected' => [$request['feature_selected']]]);
             }else{
                 return sendInternalError("Product Not Added");
             }
         }else{
             return sendInternalError("Please Select A Valid Image Combination");
         }
   }

   function addFeatureCombination(Request $request)
   {
        // $checkProduct = ProductCombination::where('combinations',json_encode($request->feature_selected))->where('product_id',$request->product_id)->first(); 
        // if($checkProduct){
        //     return redirect()->back()->withInput()->with('error',json_encode([['Combination Already Exists']]));
        // }
        //save combo
        // $combinationImages = $this->getProductImagesArray($request);
        // ProductCombination::create([
        //     'id' => Str::uuid(),
        //     'product_id' => $request->product_id,
        //     'combinations' => json_encode($request->feature_selected),
        //     'product_images' => json_encode($combinationImages),
        //     'created_by_id' => \Auth::id(),
        // ]);


        //now check  previously data have found in it product meta table or not?
        dd($request->all());

   }
}
