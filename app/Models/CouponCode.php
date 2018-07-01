<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $table = 'coupon_code';

    protected $fillable = ['couponCode', 'value', 'email', 'source', 'isUsed'];
}
