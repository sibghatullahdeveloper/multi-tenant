<?php


namespace App\Modules\V1\Roles\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Roles\Models\Role;
use App\Modules\V1\Commons\Models\RoleMenuPermission;
use App\Modules\V1\Users\Models\User;
use App\Modules\V1\Commons\Services\AuthService;
use App\Modules\V1\Roles\Services\RoleService;
use App\Modules\V1\Commons\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $authServices;
    protected $roleServices;

    public function __construct(
        AuthService $authServices,
        RoleService $roleService,
        ) {
         $this->authServices = $authServices;
         $this->roleServices = $roleService;
    }
    public function getRoleView()
    {
        return view('Roles::role.index',[
            'sidebar' => $this->authServices->getSideBar(),
            'roles' => $this->authServices->getAllRoles(['role_menu_permissions.menu','role_menu_permissions.permission']),
            'active_permissions' => $this->authServices->getPermissionsFromRole('roles'),
            'message' => '',
        ]);
    }

    public function addRoleView()
    {
        return view('Roles::role.form',[
            'sidebar' => $this->authServices->getSideBar(),
            'menus' => $this->authServices->getAllMenu(),
            'permissions' => $this->authServices->getAllPermission(),
            'error' => '',
        ]);
    }

    public function addRoleForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:roles',
            'description' => 'required|string|max:50',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages())->withInput();
        }else{

            $check = $this->roleServices->addRole($request->all());
            if($check['success'] == true){
                return Redirect::route('role.view',[
                    'role'=> \Auth::user()->role->slug,
                ])->with([
                    'sidebar' => $this->authServices->getSideBar(),
                    'roles' => $this->authServices->getAllRoles(['role_menu_permissions.menu','role_menu_permissions.permission']),
                    'active_permissions' => $this->authServices->getPermissionsFromRole('roles'),
                    'message' => 'Role Added Successfully',
                ]);
            }else{
               return redirect()->back()->with('error',[
                    [$check['message']]
                    ])->withInput();
            }
        }
        
    }

    public function editRoleView(Request $request)
    {
        $role = Role::where('uuid',$request->id)->first();
        $role_menu_permissions = RoleMenuPermission::where('role_id',$role->id)->get(['menu_id','permission_id']);
        $array = [];
        $temp = [];
        foreach ($role_menu_permissions as $key => $value) {
            $array[$value->menu_id][] = ($value->permission_id);
            array_merge($temp,$array);
        }
        return view('Roles::role.edit',[
            'sidebar' => $this->authServices->getSideBar(),
            'menus' => $this->authServices->getAllMenu(),
            'permissions' => $this->authServices->getAllPermission(),
            'error' => '',
            'role' => $role,
            'role_menu_permissions' => $array, 
        ]);   
    }

    public function editRoleForm(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required|string|max:50',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->roleServices->updateRole($request->all());
            if($check['success'] == true){
                return Redirect::route('role.view',[
                    'role'=> \Auth::user()->role->slug,                   
                ])->with([
                    'sidebar' => $this->authServices->getSideBar(),
                    'roles' => $this->authServices->getAllRoles(['role_menu_permissions.menu','role_menu_permissions.permission']),
                    'active_permissions' => $this->authServices->getPermissionsFromRole('roles'),
                    'message' => 'Role Updated Successfully',
                ]);
            }else{
                return redirect()->back()->with('error',json_encode([[$check['message']]]));
            }
        } 
    }

    public function deleteRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->roleServices->deleteRole($request->id);
            // return $check;
            if($check['success'] == true){
                return Redirect::route('role.view',[
                    'role'=> \Auth::user()->role->slug,
                ])->with([
                    'sidebar' => $this->authServices->getSideBar(),
                    'roles' => $this->authServices->getAllRoles(['role_menu_permissions.menu','role_menu_permissions.permission']),
                    'active_permissions' => $this->authServices->getPermissionsFromRole('roles'),
                    'message' => 'Role Deleted Successfully',
                ]);
            }else{
                return redirect()->back()->with('error',[[$check['message']]]);
            }
        }   
    }
}
