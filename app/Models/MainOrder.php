<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainOrder
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemOrder[] $itemsOrder
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $order_id
 * @property string $stripe_customer_id
 * @property string|null $stripe_charge_id
 * @property string|null $stripe_failure_code
 * @property string|null $stripe_failure_message
 * @property int $is_paid
 * @property string|null $stripe_payment_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereStripeChargeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereStripeCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereStripeFailureCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereStripeFailureMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereStripePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainOrder whereUserId($value)
 */
class MainOrder extends Model
{
    protected $table = 'main_orders';

    protected $fillable = [
        'stripe_customer_id',
        'order_id',
        'stripe_charge_id',
        'stripe_failure_code',
        'stripe_failure_message',
        'is_paid',
        'stripe_payment_status',
        'user_id'
        ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itemsOrder()
    {
        return $this->hasMany(ItemOrder::class, 'main_order_id', 'id');
    }
}
