<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CouponCode
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $couponCode
 * @property float $value
 * @property string|null $email
 * @property string $source
 * @property int $isUsed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereIsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereValue($value)
 */
class CouponCode extends Model
{
    protected $table = 'coupon_code';

    protected $fillable = ['couponCode', 'value', 'email', 'source', 'isUsed'];
}
