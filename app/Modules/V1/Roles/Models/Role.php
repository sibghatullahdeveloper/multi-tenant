<?php

namespace App\Modules\V1\Roles\Models;

use App\Modules\V1\Commons\Models\RoleMenuPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

	 protected $table = 'roles';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'title', 
        'slug', 
        'description', 
        'type', 
        'active',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
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

    /**
     * 
     * Timestamp converted into unix time
     * 
     */
    public function getDateFormat()
    {
        return 'U';
    }
    
    public function role_menu_permissions()
    {
        return $this->hasMany(RoleMenuPermission::class,'role_id','id');
    }

}
