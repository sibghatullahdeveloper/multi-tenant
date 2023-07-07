<?php
namespace App\Modules\V1\Roles\Services;

use App\Modules\V1\Roles\Models\Role;
use App\Modules\V1\Commons\Models\RoleMenuPermission;

class RoleService
{
    function addRole($request = [])
    {
       
        $data = [
            'uuid' => \Str::uuid(),
            'title' => $request['title'], 
            'slug' => \Str::slug($request['title']), 
            'description' => $request['description'], 
            'type' => $request['type'], 
            'created_by_id' => \Auth::id(),
            'active' => '1'
        ];

        $data = Role::create($data);
        
        if($data){
            if(array_key_exists('permissions',$request)){
                $permissions = $request['permissions'];
                foreach ($permissions as $key => $value) {
                    foreach ($value as $key_t => $value_t) {
                        $value_tf[] = ($key_t);
                        RoleMenuPermission::create(
                            [
                                'menu_id' => $key_t, 
                                'permission_id' => $value_t , 
                                'role_id' => $data->id,
                            ]
                        );   
                    }
                }
                foreach (array_unique($value_tf) as $key => $value) {
                    RoleMenuPermission::updateOrCreate([
                            'menu_id' => $value, 
                            'permission_id' => 1 , 
                            'role_id' => $data->id,
                    ],
                        [
                            'menu_id' => $value, 
                            'permission_id' => 1 , 
                            'role_id' => $data->id,
                        ]
                    );  
                }
            }
            return sendInternalSuccess("Role Added Successfully");
        }else{
            return sendInternalError('Role Not Created Something went wrong');
        }
    }

    function updateRole($request = [])
    {
        if(isset($request['permissions'])){
            $permissions = $request['permissions'];
        }
        $data = [
            'uuid' => $request['id'],
            'title' => $request['title'], 
            'slug' => \Str::slug($request['title']), 
            'description' => $request['description'], 
            'type' => $request['type'], 
            'created_by_id' => \Auth::id(),
            'active' => '1'
        ];

        $role = Role::where('uuid',$request['id']);
        $data = $role->update([
            'title' => $request['title'], 
            'slug' => \Str::slug($request['title']), 
            'description' => $request['description'], 
        ]); 
        $role = $role->first();   
        /**
         * 
         * Delete Records before insert 
         * 
         */
        
        $previous_delete = RoleMenuPermission::where('role_id',$role->id)->delete();
        
            if(isset($permissions)){
                foreach ($permissions as $key => $value) {
                    foreach ($value as $key_t => $value_t) {
                        $value_tf[] = ($key_t);
                        RoleMenuPermission::create(
                            [
                                'menu_id' => $key_t, 
                                'permission_id' => $value_t , 
                                'role_id' => $role->id,
                            ]
                        );   
                    }
                }

                foreach (array_unique($value_tf) as $key => $value) {
                    RoleMenuPermission::updateOrCreate([
                            'menu_id' => $value, 
                            'permission_id' => 2, 
                            'role_id' => $role->id,
                    ],
                        [
                            'menu_id' => $value, 
                            'permission_id' => 2 , 
                            'role_id' => $role->id,
                        ]
                    );  
                }
                return sendInternalSuccess("Role Added Successfully");
            }else{
                return sendInternalSuccess("Role Added Successfully");
            }    
    }

    function deleteRole($id)
    {
        /**
         * IF Role deleted then delete its permissions from mapping
         * 
         */
        $check = Role::where('uuid',$id)->first();
        $previous_perm_delete = RoleMenuPermission::where('role_id',$check->id)->delete();

        
        $check = $check->delete();
        if($check){
            return sendInternalSuccess('Role and Its permissions deleted Successfully');
        }else{
            return sendInternalError('Role Not Deleted But Permission Deleted');    
        }
    
    }
}