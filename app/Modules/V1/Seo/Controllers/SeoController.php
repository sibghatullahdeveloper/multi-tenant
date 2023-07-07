<?php


namespace App\Modules\V1\Seo\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Commons\Services\AuthService;
use App\Modules\V1\Seo\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SeoController extends Controller
{
    protected $authServices;
    protected $seoService;

    public function __construct(
        AuthService $authServices,
        SeoService $seoService,
    ) {
        $this->authServices = $authServices;
        $this->seoService = $seoService;
    }

    public function view()
    {
        return view('Seo::seo.index',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
            'message' => '',
            'seos' => $this->seoService->get(),
        ]);
    }

    public function addView()
    {
        return view('Seo::seo.form',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
            'message' => '',
        ]);
    }

    public function store(Request $request)
    {
        $p=parse_url($request['url']);
        if(isset($p['host'])){
          $url = (str_replace('/'.Auth::user()->role->slug.'/',"",$p['path']));
        }else{
          $url = $p['path'];
        }
        $request->merge([
            'title' => $url,
        ]);
        $validator = Validator::make($request->all(), [
            'url' => 'required',
            'title' => 'required | max:70 | unique:seo,title',
            'keywords' => 'required | max:300',
            'description' => 'required | max:160',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->seoService->store($request->all());
            return Redirect::route('seo.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
                'message' => '',
                'seos' => $this->seoService->get(),
            ]); 
        }
        
    }

    public function editView(Request $request)
    {
        if(!$request->id){
            return Redirect::route('seo.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
                'message' => 'Mo View Found',
                'seos' => $this->seoService->get(), 
            ]); 
        }
        return view('Seo::seo.edit',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
            'message' => '',
            'data' => $this->seoService->get($request->id),
            'id' => $request->id,
        ]); 
    }

    public function update(Request $request)
    {
        $p=parse_url($request['url']);
        if(isset($p['host'])){
          $url = (str_replace('/'.Auth::user()->role->slug.'/',"",$p['path']));
        }else{
          $url = $p['path'];
        }
        $request->merge([
            'title' => $url,
        ]);

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'url' => 'required | max:70',
            'title' => 'required | max:70',
            'keywords' => 'required | max:300',
            'description' => 'required | max:160',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->seoService->update($request->all());
            if($check['success'] == false){
                return redirect()->back()->with('error',json_encode([[$check['message']]]));
            }else{
                return Redirect::route('seo.edit.view',[
                    'role'=> \Auth::user()->role->slug,                   
                ])->with([
                    'sidebar' => $this->authServices->getSideBar(),
                    'active_permissions' => $this->authServices->getPermissionsFromRole('seo'),
                    'message' => '',
                    'data' => $this->seoService->get($request->id),
                    'id' => $request->id,
                ]); 
            }
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
            $check = $this->seoService->delete($request->all());
            return Redirect::route('seo.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
                'message' => '',
                'seos' => $this->seoService->get(), 
            ]); 
        }
    }
}
