<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionTypes extends Model
{
    public $fillable = [
        'name',
        'code',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required',
    ];


//    function user()
//    {
//        return $this->belongsTo(\App\User::class);
//    }
}
