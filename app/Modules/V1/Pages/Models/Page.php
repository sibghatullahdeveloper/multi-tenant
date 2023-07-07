<?php

namespace App\Modules\V1\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

	 protected $table = 'pages';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'title', 
        'slug', 
        'content', 
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
