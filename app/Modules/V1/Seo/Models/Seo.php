<?php

namespace App\Modules\V1\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

	 protected $table = 'seo';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'title', 
        'url', 
        'slug', 
        'meta_keywords', 
        'meta_description',
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
    protected $casts = [
        'id' => 'string'
    ];
    /*
    * 
    * Timestamp converted into unix time
    * 
    */
    public function getDateFormat()
    {
        return 'U';
    }

}
