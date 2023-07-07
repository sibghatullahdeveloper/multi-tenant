<?php


namespace App\Modules\V1\Features\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Categories\CategoryModuleExports;
use App\Modules\V1\Features\Services\FeatureValueService;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FeatureValueController extends Controller
{
    protected $featureService;
    protected $userServices;

    public function __construct(
        FeatureValueService $featureService,
        UserService $userService,
        ) {;
         $this->userServices = $userService;
         $this->featureService = $featureService;
    }

    public function view(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required | exists:feature,id',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }
        return view('Features::feature-value.index',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'feature_values' => $this->featureService->get($request->id),
            'feature_id' => $request->id,
        ]);
    }

    public function addView(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required | exists:feature,id',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }

        return view('Features::feature-value.form',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'feature_id' => $request->id,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required | max:70 | unique:feature_value,title',
            'sort_order' => 'required | numeric ',
            'description' => 'required | max:160',
            'feature_id' => 'required | exists:feature,id',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }else{
            $this->featureService->store($request->all());
            return Redirect::route('feature-value.view',[
                'role'=> \Auth::user()->role->slug,
                'id' => $request->feature_id,                  
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
        if(!$request->id || !$request->feature_value_id){
            return Redirect::route('feature-value.view',[
                'role'=> \Auth::user()->role->slug,
                'id' => $request->feature_id,                  
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
                'message' => 'No View Found',
                'features' => $this->featureService->get(), 
            ]); 
        }
        // dd($this->featureService->getByUUID($request->feature_value_id));
        return view('Features::feature-value.edit',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('features'),
            'message' => '',
            'data' => $this->featureService->getByUUID($request->feature_value_id),
            'id' => $request->feature_value_id,
            'feature_id' => $request->id,

        ]); 
        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:70 | unique:feature_value,title',
            'sort_order' => 'required | numeric ',
            'description' => 'required | max:160',
            'feature_id' => 'required | exists:feature,id',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->with('error',$validator->messages());
        }else{
            $this->featureService->store($request->all(),$request->id);
            return Redirect::route('feature-value.view',[
                'role'=> \Auth::user()->role->slug,    
                'id' => $request->feature_id,                  
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('seo'),
                'message' => '',
                'features' => $this->featureService->get(),                
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
            return Redirect::route('feature-value.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('pages'),
                'message' => '', 
                'features' => $this->featureService->get(),

            ]); 
        }
    }
 
}
