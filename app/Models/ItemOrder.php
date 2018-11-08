<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $table = 'items_order';

    protected $fillable = [
        'voyage_id',
        'voyage_name',
        'num_of_passenger',
        'prix_unitaire',
        'prix_final',
        'date_voyage',
        'main_order_id',
    ];


    public function mainOrder()
    {
        return $this->belongsTo(MainOrder::class);
    }

}
