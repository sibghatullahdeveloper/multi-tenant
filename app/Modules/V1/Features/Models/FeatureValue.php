<?php

namespace App\Modules\V1\Features\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    use HasFactory;

	 protected $table = 'feature_value';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'title', 
        'slug', 
        'feature_id', 
        'sort_order', 
        'description', 
        'icon_path', 
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

    public function features()
    {
     return $this->hasOne(__NAMESPACE__ .'\Feature', 'id','feature_id');
    }
}
