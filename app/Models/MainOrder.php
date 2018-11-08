<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
