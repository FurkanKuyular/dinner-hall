<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'price',
        'point',
        'order_id',
        'user_id',
        'ref_code',
        'callback_success_url',
        'callback_fail_url',
        'hash',
        'is_success',
    ];
}
