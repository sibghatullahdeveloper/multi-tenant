<?php


namespace App\Modules\V1\Categories\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Categories\Models\Category;
use App\Modules\V1\Categories\Services\CategoryService;
use App\Modules\V1\Commons\Services\AuthService;
use App\Modules\V1\Roles\Services\RoleService;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $userServices;

    public function __construct(
        CategoryService $categoryService,
        UserService $userService,
        ) {;
         $this->userServices = $userService;
         $this->categoryService = $categoryService;
    }

    public function getCategoryView(Request $request)
    {
        return view('Categories::category.index',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
            'message' => '',
            'categories' => Category::with(['children'])->whereNull('category_id')->get(),
            'sub_categories' => Category::with(['children'])->whereNotNull('category_id')->get(),
        ]); 
    }

    public function getAddCategoryView(Request $request)
    {
        return view('Categories::category.form',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
            'message' => '',
            'parent_id' => $request->parent,
        ]); 
    }

    public function getAddCategoryForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->categoryService->addCategory($request->all());
            return Redirect::route('category.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
                'message' => '',
                'categories' => Category::with(['children'])->get(),
            ]); 
        }
    }


    public function getdeleteCategoryForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->categoryService->deleteCategory($request->id);
            return Redirect::route('category.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
                'message' => '',
                'categories' => Category::with(['children'])->get(),
            ]); 
        }
    }


    public function getEditCategoryView(Request $request)
    {
        if(!$request->parent){
            return Redirect::route('category.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
                'message' => '',
                'categories' => Category::with(['children'])->get(),
            ]); 
        }
        
        return view('Categories::category.edit',[
            'sidebar' => $this->userServices->getSideBar(),
            'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
            'message' => '',
            'data' => $this->categoryService->getCategoryById($request->parent),
            'parent_id' => $request->parent,
        ]); 
    }


    public function getEditCategoryForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $this->categoryService->updateCategory($request->all());
            return Redirect::route('category.view',[
                'role'=> \Auth::user()->role->slug,                   
            ])->with([
                'sidebar' => $this->userServices->getSideBar(),
                'active_permissions' => $this->userServices->getPermissionsFromRole('category'),
                'message' => '',
                'categories' => Category::with(['children'])->get(),
            ]); 
        }
    }
}
