<?php

namespace App\Modules\V1\Commons\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

	 protected $table = 'permission';

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


}
