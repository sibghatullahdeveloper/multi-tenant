<?php


namespace App\Modules\V1\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Categories\CategoryModuleExports;
use App\Modules\V1\Features\FeatureModuleExports;
use App\Modules\V1\Product\Services\ProductService;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\V1\Product\Models\Product;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    protected $productService;
    protected $userServices;

    public function __construct(
        UserService $userService,
        ProductService $productService,
        ) {;
         $this->userServices = $userService;
         $this->productService = $productService;
    }

    public function view()
    {
        return view('Product::product.index',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('product'),
            'message' => '',
            // 'features' => $this->featureService->get('',true),
        ]);
    }

    /**
     * 
     * Simple Product Functions
     * 
     */
    public function addView()
    {
        return view('Product::product.single',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'parent_categories' => CategoryModuleExports::getCategoryObject()->where('category_id',null)->get(['id','title']),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required | min:10",
            "main_category" => "required |exists:category,id",
            "subcategory" => "required |exists:category,id",
            "price" => "required | min:1",
            "description" => "required | min:5",
            "quantity" => "required | min:1",
            "image" => 'required',
        ]);

        if($validator->fails()) {
            return sendError('Please Fill the Described Fields',$validator->messages());
        }else{
            return $this->productService->storeSimpleProduct($request);
            // return sendSuccess("Your Sub Categories are here",$data);
        }
    }

    /**
     * 
     * Variable Product Functions
     * 
     */
    public function addVariableView()
    {
        return view('Product::product.variable',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'parent_categories' => CategoryModuleExports::getCategoryObject()->where('category_id',null)->get(['id','title']),
        ]);
    }

    public function addVariableForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required | min:10",
            "main_category" => "required |exists:category,id",
            "subcategory" => "required |exists:category,id",
            "price" => "required | min:1",
            "description" => "required | min:5",
            "quantity" => "required | min:1",
            "image" => 'required',
            "feature_selected" => 'required',
        ]);

        if($validator->fails()) {
            return sendError('Please Fill the Described Fields',$validator->messages());
        }else{
            return $this->productService->storeVariableProduct($request);
            // if($check['success'] == true){
            //     return Redirect::route('product.add.variable.feature-value.view',[
            //         'role'=> \Auth::user()->role->slug,
            //         'product_id' => $check['data']['product_id'],                   
            //     ])->with([
            //         'sidebar' => $this->userServices->getSideBar(),
            //         'active_permissions' => $this->userServices->getPermissionsFromRole('seo'),
            //         'message' => '',
            //         'features_selected' => $check['data']['feature_selected'],      
            //     ]);
            // }
            // return sendSuccess("Your Sub Categories are here",$data);
        }   
    }
    

    public function getSubCategories(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'id' => 'required |exists:category,id',
        ]);

        if($validator->fails()) {
            return sendError('Please Select Valid Category',$validator->messages());
        }else{
            $data = CategoryModuleExports::getCategoryObject()->where('category_id',$request->id)->get(['id','title']);
            return sendSuccess("Your Sub Categories are here",$data);
        }

    }

    public function getFeature(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required |exists:category,id',
        ]);

        if($validator->fails()) {
            return sendError('Please Select Valid Sub Category',$validator->messages());
        }else{
            $data = FeatureModuleExports::getFeatureObject()->whereRaw('JSON_CONTAINS(categories_id, ?)', [json_encode($request->id)])->with('feature_value')->get();
            return sendSuccess("Your Features are here",$data);
        }
    }

    // Product Feature Functions 
    public function addVariableFeatureValueView(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feature_selected' => 'required',
            'product_id' => 'required',
        ]);

        if($validator->fails()) {
              return Redirect::route('product.view',[
                    'role'=> \Auth::user()->role->slug,                   
                ])->with([
                    'sidebar' => $this->userServices->getSideBar(),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('product'),
                    'message' => '',      
                ]);
        }else{
            $temp_features = json_decode($request->feature_selected); 
            $str_arr = preg_split ("/\,/", $temp_features[0]); 
            $selected_feature_value = [];
            foreach ($str_arr as $value) {
                $selected_feature_value[] = FeatureModuleExports::getFeatureValueObject()->where('feature_id',$value)->with('features')->get();
            }

            //get previous combination
            $productcombination = Product::where('id',$request->product_id)->with('combinations')->first();
            return view('Product::product.feature-values.add',[
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
                'message' => '',
                'product_id' => $request->product_id,
                'product_combinations' => $productcombination,
                'selected_feature_value' => $selected_feature_value,
            ]);
        }

        
    }

    public function addVariableFeatureValueForm(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required | file',
            'feature_selected' => 'required | array'
        ]);
          // dd($request->all(),$validator->fails());

        if($validator->fails()) {
              return redirect()->back()->withInput()->with('error',$validator->messages());
        }else{
            return $this->productService->addFeatureCombination($request);

        }


    }

}
