<?php

namespace App\Modules\V1\Commons\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\V1\Roles\Models\Role;

class RoleMenuPermission extends Model
{
    use HasFactory;

	 protected $table = 'role_has_permission_with_menu';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'menu_id', 
        'permission_id', 
        'role_id',
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];

	/**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];


	 /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function menu()
    {
        return $this->belongsTo(__NAMESPACE__ .'\Menu', 'menu_id');
    }

    public function permission()
    {
        return $this->belongsTo(__NAMESPACE__ .'\Permission', 'permission_id');
    }

     /**
     * 
     * Timestamp converted into unix time
     * 
     */
    public function getDateFormat()
    {
        return 'U';
    }
     

}
