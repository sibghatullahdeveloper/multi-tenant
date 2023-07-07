<?php

namespace App\Modules\V1\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

	 protected $table = 'product_meta';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
            'id',
            'product_id',
            'values',
            'feature',
            'slug',
            'quantity',
            'starting_price',
            'reserved_quantity',
            'has_value_price',
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

}
