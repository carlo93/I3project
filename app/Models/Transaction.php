<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = [
        'description',
        'user_id',
        'transaction_type_id',
        'amount',
        'usd_rate',
        'usd_amount',
        'usd_balance',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_type_id' => 'integer',
        'description' => 'string',
        'first_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        'transaction_type_id' => 'required',
        'amount' => 'required',
    ];


    function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function transaction_types()
    {
        return $this->belongsTo(\App\Models\TransactionTypes::class, 'transaction_type_id');
    }
}
