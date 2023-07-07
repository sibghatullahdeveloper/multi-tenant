<?php

namespace App\Modules\V1\Categories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	 protected $table = 'category';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'title', 
        'description', 
        'category_id', 
        'created_by_id', 
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


    /**Relations */
    
    public function parent()
    {
        return $this->belongsTo(__NAMESPACE__ .'\Category', 'category_id');
    }

    public function children()
    {
        return $this->hasMany(__NAMESPACE__ .'\Category', 'category_id')->with('children');
    }

}
