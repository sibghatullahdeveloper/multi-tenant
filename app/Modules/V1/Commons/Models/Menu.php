<?php

namespace App\Modules\V1\Commons\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Menu extends Model
{
    use HasFactory;

	 protected $table = 'menu';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'title', 
        'slug', 
        'link',
        'icon',
        'description', 
        'type', 
        'active',
        'sorting_order',
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
