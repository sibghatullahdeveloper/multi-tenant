<?php


namespace App\Modules\V1\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Users\Models\User;
use App\Modules\V1\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    protected $userServices;

    public function __construct(UserService $userService) {
        $this->userServices = $userService;
    }
    
    public function getUserView(Request $request)
    {
        return view('Users::users.index',[
            'sidebar' => $this->userServices->getSideBar(),
            'users' => $this->userServices->getAllUsers(['role']),
            'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
            'message' => '',
        ]);
    }

    public function addUserView(Request $request)
    {
        return view('Users::users.form',[
            'sidebar' => $this->userServices->getSideBar(),
            'roles' => $this->userServices->getAllRoles(),
            'error' => '',
        ]);
    }


    public function editUserView(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages())->withInput();
        }else{
            $user = User::where('uuid',$request->id)->with('role')->first();
            return view('Users::users.edit',[
                'sidebar' => $this->userServices->getSideBar(),
                'permissions' => $this->userServices->getAllPermission(),
                'roles' => $this->userServices->getAllRoles(),
                'error' => '',
                'user' => $user, 
            ]); 
        }  
    }
    
    public function editUserForm(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            // 'password' => 'required',
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages())->withInput();
        }else{
            $check = $this->userServices->updateUsers($request->all());
            if($check['success'] == true){
                return Redirect::route('users.view',[
                    'role'=> \Auth::user()->role->slug,
                ])->with([
                    'sidebar' => $this->userServices->getSideBar(),
                    'users' => $this->userServices->getAllUsers(['role']),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
                    'message' => '',
                ]);
            }else{
                return view('Users::users.form',[
                    'sidebar' => $this->userServices->getSideBar(),
                    'roles' => $this->userServices->getAllRoles(),
                    'error' => 'Please Contact Admin',
                ]);
            }
        } 
    }

    public function deleteUser(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);  
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages())->withInput();
        }else{
            $check = $this->userServices->deleteUsers($request->id);
            if($check['success'] == true){
                return Redirect::route('users.view',[
                    'role'=> \Auth::user()->role->slug,
                ])->with([
                    'sidebar' => $this->userServices->getSideBar(),
                    'users' => $this->userServices->getAllUsers(['role']),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
                    'message' => 'User Deleted Successfully',
                ]);
            }else{
                return view('Users::users.form',[
                    'sidebar' => $this->userServices->getSideBar(),
                    'roles' => $this->userServices->getAllRoles(),
                    'error' => 'Please Contact Admin',
                ]);
            } 
        }

    }



    

    public function addUserForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'type' => 'required',
            'profile_image' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages())->withInput();
        }else{
            $check = $this->userServices->addUsers($request->all());
            if($check['success'] == true){
                return view('Users::users.index',[
                    'sidebar' => $this->userServices->getSideBar(),
                    'users' => $this->userServices->getAllUsers(['role']),
                    'active_permissions' => $this->userServices->getPermissionsFromRole('users'),
                    'message' => '',
                ]);
            }else{
                return view('Commons::users.form',[
                    'sidebar' => $this->userServices->getSideBar(),
                    'roles' => $this->userServices->getAllRoles(),
                    'error' => 'Please Contact Admin',
                ]);
            }
        }
         
    }
}
