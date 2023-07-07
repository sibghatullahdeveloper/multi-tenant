<?php

namespace App\Modules\V1\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	 protected $table = 'product';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title', 
        'slug', 
        'type', 
        'total_quantity', 
        'min_price', 
        'max_price', 
        'reserved_quanity', 
        'max_order_limit', 
        'rating', 
        'images_features',
        'review_count', 
        'category_id', 
        'sub_category_id', 
        'has_value_price', 
        'features', 
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

    public function combinations()
   {
    return $this->hasMany(__NAMESPACE__ .'\ProductCombination', 'product_id');
   }


}
