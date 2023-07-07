<?php

namespace App\Modules\V1\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCombination extends Model
{
    use HasFactory;

	 protected $table = 'product_combination_images';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'combinations',
        'product_images',
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

    public function product()
    {
     return $this->hasOne(__NAMESPACE__ .'\Product', 'id','product_id');
    }


}
