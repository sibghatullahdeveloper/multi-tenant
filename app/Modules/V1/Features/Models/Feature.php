<?php

namespace App\Modules\V1\Features\Models;

use App\Modules\V1\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

	 protected $table = 'feature';


	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'title', 
        'display_type', 
        'categories_id', 
        'sort_order', 
        'description', 
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
       'id' => 'string',
       'categories_id' => 'array',
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

   //    relations
   public function feature_value()
   {
    return $this->hasMany(__NAMESPACE__ .'\FeatureValue', 'feature_id');
   }

}
