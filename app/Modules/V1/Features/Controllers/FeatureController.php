<?php


namespace App\Modules\V1\Features\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Categories\CategoryModuleExports;
use App\Modules\V1\Features\Services\FeatureService;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    protected $featureService;
    protected $userServices;

    public function __construct(
        FeatureService $featureService,
        UserService $userService,
        ) {;
         $this->userServices = $userService;
         $this->featureService = $featureService;
    }

    public function view()
    {
        return view('Features::feature.index',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'features' => $this->featureService->get('',true),
            // 'seos' => $this->seoService->get(),
        ]);
    }

    public function addView()
    {
        return view('Features::feature.form',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'input_field_types' => config('fields_types'),
            'categories' => CategoryModuleExports::getCategoryObject()->all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:70 | unique:feature,title',
            'sort_order' => 'required | numeric ',
            'description' => 'required | max:160',
            'category' => 'required | array',
            'display_type' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }else{
            $this->featureService->store($request->all());
            return Redirect::route('features.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
                'message' => '',
                'features' => $this->featureService->get(),
            ]); 
        }
    }

    public function editView(Request $request)
    {
        if(!$request->id){
            return Redirect::route('features.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
                'message' => 'No View Found',
                // 'input_field_types' => config('fields_types'),
                'features' => $this->featureService->get('',true),
            ]); 
        }
        return view('Features::feature.edit',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'input_field_types' => config('fields_types'),
            'data' => $this->featureService->get($request->id),
            'id' => $request->id,
            'categories' => CategoryModuleExports::getCategoryObject()->all(),

        ]); 
        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:70 | unique:seo,title',
            'sort_order' => 'required | numeric ',
            'description' => 'required | max:160',
            'category' => 'required',
            'display_type' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }else{
            $this->featureService->store($request->all(),$request->id);
            return Redirect::route('features.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('seo'),
                'message' => '',
                'features' => $this->featureService->get('',true),      

                
            ]); 
        }
       
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->featureService->delete($request->all());
            return Redirect::route('features.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('pages'),
                'message' => '', 
                'features' => $this->featureService->get('',true),
            ]); 
        }
    }
 
}
