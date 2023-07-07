<?php

namespace App\Modules\V1\Users\Services;

use App\Modules\V1\Commons\Models\Menu;
use App\Modules\V1\Commons\Models\Permission;
use App\Modules\V1\Roles\Models\Role;
use App\Modules\V1\Commons\Models\RoleMenuPermission;
use App\Modules\V1\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    function loginAuthentication($user){
        /*
            Generating Auth for our guard
        */

        $adminCheck = Auth::attempt(['email'=>$user['email'], 'password'=>$user['password']]);
        
        if($adminCheck){
            return sendInternalSuccess('User Logged In Successfully');
        }else{
            return sendInternalError("Please Provide with correct credentials");
        }
    }

    function getSideBar()
    {
        
        $role_menu_permission = RoleMenuPermission::where('role_id',Auth::user()->role_id)
        ->with([
            'menu',
            'permission'
        ])->get();
        
        return $role_menu_permission;
    }

    function getAllUsers($relations=[])
    {
        if($relations != []){
            return User::with($relations)->get();
        }else{
            return User::where('id','>','0')->get();
        }
    }

    function getAllRoles($relations=[])
    {
        if($relations != []){
            return Role::with($relations)->get();
        }else{
            return Role::where('id','>','0')->get();
        }
    }

    function getAllMenu($relations=[])
    {
        if($relations != []){
            return Menu::with($relations)->get();
        }else{
            return Menu::where('id','>','0')->get();
        }
    }

    function getPermissionsFromRole($menu)
    {
        $menu_id = Menu::where('slug','=',$menu)->pluck('id');
        $permissions = RoleMenuPermission::where('role_id',\Auth::user()->role->id)->where('menu_id',$menu_id)->with('permission')->get('permission_id');
        $permissions_array = [];
        foreach ($permissions as $key => $value) {
            $permissions_array[] = $value->permission->slug; 
        }
        return ($permissions_array);
    }

    function getAllPermission($relations=[])
    {
        if($relations != []){
            return Permission::with($relations)->get();
        }else{
            return Permission::where('id','>','0')->get();
        }   
    }


    function addUsers($request)
    {
        /** Upload The Image First */
        $image_name = 'nill';

        if($request['profile_image']){
            $image_name = date('mdYHis') . uniqid() . $request['profile_image']->getClientOriginalName();
            $image_name = $request['profile_image']->storeAs('/public/image', $image_name);
        }

        $check = User::create([
            'uuid' => \Str::uuid(),
            'role_id' => $request['role'], 
            'first_name' => $request['first_name'], 
            'last_name' => $request['last_name'], 
            'email' => $request['email'], 
            'password' => Hash::make($request['password']), 
            'type' => $request['type'], 
            'lat' => '0.00',
            'long' => '0.00',
            'phone_number' => $request['phone_number'], 
            'image_path' => $image_name,
        ]);

        if($check){
            return sendInternalSuccess('User Added Successfully');
        }else{
            return sendInternalError('User Not Created, Kindly Contact Admin');
        }
    }

    public function updateUsers($request=[])
    {
         /** Upload The Image First */
         $check = '';
         if(isset($request['profile_image'])){
             $image_name = date('mdYHis') . uniqid() . $request['profile_image']->getClientOriginalName();
             $image_name = $request['profile_image']->storeAs('/public/image', $image_name);
             
             $check = User::where('uuid',$request['id'])->update([
                'role_id' => $request['role'], 
                'first_name' => $request['first_name'], 
                'last_name' => $request['last_name'], 
                'email' => $request['email'], 
                // 'password' => Hash::make($request['password']), 
                'type' => $request['type'], 
                'lat' => '0.00',
                'long' => '0.00',
                'phone_number' => $request['phone_number'], 
                'image_path' => $image_name,
            ]);
         }else{
            $check = User::where('uuid',$request['id'])->update([
                'role_id' => $request['role'], 
                'first_name' => $request['first_name'], 
                'last_name' => $request['last_name'], 
                'email' => $request['email'], 
                // 'password' => Hash::make($request['password']), 
                'type' => $request['type'], 
                'lat' => '0.00',
                'long' => '0.00',
                'phone_number' => $request['phone_number'], 
            ]);
         }
        if($check){
            return sendInternalSuccess('User Updated Successfully');
        }else{
            return sendInternalError('User Not Updated, Kindly Contact Admin');
        }
    }

    function deleteUsers($id)
    {
        $check = User::where('uuid',$id)->delete();

        if($check){
            return sendInternalSuccess('User deleted Successfully');
        }else{
            return sendInternalError('User Not Deleted ');    
        }
    }

    function sendMail($data, $view, $subject, $replyTo = 'support@multi-tenant.com', $from = 'support@multi-tenant.com') {

        \Mail::send($view, $data, function($message) use ($data, $subject, $replyTo, $from) {
            $message->getHeaders()->addTextHeader('Reply-To', $replyTo);
            $message->getHeaders()->addTextHeader('Return-Path', $replyTo);
            $message->to($data['receiver_email'], $data['receiver_name']);
            $message->subject($subject);
            $message->from($from, $data['sender_name']);
            $message->sender($from, $data['sender_name']);
        });
    }

    public function verifyEmail()
    {
        $data = $this->reqData->only('verification_code');

        $user = $this->user;

        if ($user != null) {
            if ($user->verification_code == $data['verification_code']) {
                $user->update(['verification_code' => '', 'is_verified' => 1,'email_verification'=>1]);
            }
        }
        return $user;
    }

    public function forgotPassword($request)
    {
        $rData = $request['email'];
        if (isset($rData)) {
            $user = User::where(['email' => $rData])->first();
            if ($user) {
                $code = rand(1000, 9999);
                $data['receiver_name'] = $user->first_name .' '. $user->last_name  ;
                $data['receiver_email'] = $user->email;
                $data['sender_name'] = 'Multi-tenant';
                $data['sender_email'] = 'info@multi-tenant.com';
                $data['verification_code'] = $code;
                $user->update(['verification_code' => $code]);
                $this->sendMail($data, 'Commons::emails.forgot-password', 'Reset Password Code is '.$data['verification_code'], $data['sender_email']);
                return $user;
            } else {
                return false;
            }
        }
        return false;

    }

    public function resetPassword(Request $reqData)
    {
        $reqData = $reqData->only('email', 'password', 'code');
        //$user = User::where("verification_code", $reqData["verification_code"])->first();
        $user = User::where("email", $reqData["email"])->first();
        if ($user) {
                $user = User::where("email", $reqData["email"])->where("verification_code", $reqData["code"])->first();
                if($user){
                    if ($reqData['code'] == $user->verification_code) {
                        $user->update(
                            [
                                'password' => bcrypt($reqData['password']),
                                'verification_code' => ''
                            ]);
                        return sendInternalSuccess('Code Verified',[$user]);
                    }
                }else{
                    return sendInternalError('Code Mismatched');
                }
            }else{
                return sendInternalError('User Not Found');
            }
        return false;
    }

    function editProfile($request)
    {
        $check = User::where('id',$request['id'])->update([
            'first_name' => $request['first_name'], 
            'last_name' => $request['last_name'], 
            'email' => $request['email'], 
            'lat' => '0.00',
            'long' => '0.00',
            'phone_number' => $request['phone_number'], 
        ]);

        if($check){
            return sendInternalSuccess('Profile Edit Successfully');
        }else{
            return sendInternalError('User Profile Not Updated, Kindly Contact Admin');
        }
    }


}
