<?php

namespace App\Modules\V1\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    use HasFactory;

	 protected $table = 'currency_conversion';

	 /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 
        'code', 
        'source_currency', 
        'target_currency', 
        'closing_rate', 
        'average_rate', 
        'is_base_currency', 
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

    public function target()
    {
        return $this->belongsTo(__NAMESPACE__ .'\Currency', 'target_currency','id');
    }


    public function source()
    {
        return $this->belongsTo(__NAMESPACE__ .'\Currency', 'source_currency','id');
    }

}
