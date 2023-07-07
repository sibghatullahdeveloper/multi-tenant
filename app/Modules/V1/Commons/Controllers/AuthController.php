<?php


namespace App\Modules\V1\Commons\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Users\Models\User;
use App\Modules\V1\Commons\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    protected $authServices;

    public function __construct(AuthService $authServices) {
        $this->authServices = $authServices;
    }
    
    public function getLoginView()
    {
        return view('Commons::auth.login')->with(['success'=>'']);
    }

    public function postLogin(Request $request)
    {
        /*
            Using Validator to Validate Login
        */
        $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $returnValidateLogin = $this->authServices->loginAuthentication($request->only('email','password'));

            if($returnValidateLogin['success'] == true){
                //get role of user
                $user = User::find(\Auth::id());
                return Redirect::route('dashboard.view',['role'=>$user->role->slug]);    
            }else{
                // dd($returnValidateLogin['message']);
                return Redirect::back()->with('error', json_encode([['Kindly Provide Correct Credentials']]));
            }
        }
    }

    public function logOut(Request $request)
    {
        \Auth::logout();
        return Redirect::route('admin.login.view');
    }

    public function forgotPasswordView()
    {
        return view('Commons::auth.forgot-password'); 
    }

    public function sendEmailCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->authServices->forgotPassword($request);
            
            if($check){
                return Redirect::route('admin.verify.code.view',['email' => $check->email])->with(['email' => $check->email]);
            }else{
                return redirect()->back()->with('error',json_encode([['Email Not Found']]));
            }    
        }
        
    }
    public function verifyCodeView(Request $request)
    {
        
        if(!$request->email){
            return Redirect::route('admin.login.view');
        }else{
            return view('Commons::auth.verify-code',['email' => $request->email]);
        }
    }

    public function verifyCodeForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'code' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->authServices->resetPassword($request);
            if($check['success'] == true ){
                return Redirect::route('admin.login.view');
            }else{
                return redirect()->back()->with('error',json_encode([[$check['message']]])); 
            }
        }

    }

    public function editProfileView()
    {
        $user = User::where('id',\Auth::id())->with('role')->first();
        return view('Commons::auth.edit-profile',[
            'sidebar' => $this->authServices->getSideBar(),
            'permissions' => $this->authServices->getAllPermission(),
            'roles' => $this->authServices->getAllRoles(),
            'error' => '',
            'user' => $user, 
        ]); 
    }

    public function editProfileForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'id' => 'required|numeric',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'profile_image' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->authServices->editProfile($request->all());
            if($check['success'] == true){
                return Redirect::route('edit.profile.view',[
                    'role'=> \Auth::user()->role->slug,
                ]);
            }else{
                return redirect()->back()->with('error',json_encode([[$check['message']]])); 
            }
        }    
    }

    public function editProfilePasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->messages());
        }else{
            $check = $this->authServices->changePassword($request->all());
            if($check['success'] == true){
                return Redirect::route('edit.profile.view',[
                    'role'=> \Auth::user()->role->slug,
                    'success' => 'Password Changes Successfully',
                ]);
            }else{
                return redirect()->back()->with('error',json_encode([[$check['message']]])); 
            }
        }
    }
    


}
