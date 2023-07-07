<?php

namespace App\Modules\V1\Users\Models;

use App\Modules\V1\Roles\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'role_id', 
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'type', 
        'lat', 
        'long', 
        'phone_number', 
        'fcm_token', 
        'is_whatsapp_available', 
        'verification_code',
        'last_login',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


   

    protected $with = [
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * 
     * Timestamp converted into unix time
     * 
     */
    public function getDateFormat()
    {
        return 'U';
    }

    

    /**
     * 
     * 
     * User Relationship with roles
     * 
     */

     public function role()
     {
        return $this->belongsTo(Role::class, 'role_id','id');
     }
     
}
