<?php


namespace App\Modules\V1\Pages\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Commons\Services\AuthService;
use App\Modules\V1\Pages\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    protected $authServices;
    protected $pageService;

    public function __construct(
        AuthService $authServices,
        PageService $pageService,
    ) {
        $this->authServices = $authServices;
        $this->pageService = $pageService;
    }

    public function view()
    {
        return view('Pages::pages.index',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
            'message' => '',
            'pages' => $this->pageService->get(),
        ]);
    }

    public function addView()
    {
        return view('Pages::pages.form',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
            'message' => '',
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->pageService->store($request->all());
            return Redirect::route('pages.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
                'message' => '',
                'pages' => $this->pageService->get(),
            ]); 
        }
        
    }

    public function editView(Request $request)
    {
        if(!$request->id){
            return Redirect::route('pages.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
                'message' => 'Mo View Found',
                'pages' => $this->pageService->get(),
            ]); 
        }
        
        return view('Pages::pages.edit',[
            'sidebar' => $this->authServices->getSideBar(),
            'active_permissions' => $this->authServices->getPermissionsFromRole('category'),
            'message' => '',
            'data' => $this->pageService->get($request->id),
            'id' => $request->id,
        ]); 
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->pageService->update($request->all());
            return Redirect::route('pages.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
                'message' => '',
                'pages' => $this->pageService->get(),
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
            $check = $this->pageService->delete($request->all());
            return Redirect::route('pages.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->authServices->getSideBar(),
                'active_permissions' => $this->authServices->getPermissionsFromRole('pages'),
                'message' => '',
                'pages' => $this->pageService->get(),
            ]); 
        }
    }
}
