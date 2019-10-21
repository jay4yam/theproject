<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemOrder
 *
 * @property-read \App\Models\MainOrder $mainOrder
 * @property-read \App\Models\Voyage $voyage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $voyage_id
 * @property string $voyage_name
 * @property int $num_of_passenger
 * @property float $prix_unitaire
 * @property float $prix_final
 * @property \Illuminate\Support\Carbon $date_voyage
 * @property int $main_order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereDateVoyage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereMainOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereNumOfPassenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder wherePrixFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder wherePrixUnitaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereVoyageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemOrder whereVoyageName($value)
 */
class ItemOrder extends Model
{
    protected $table = 'items_order';

    protected $dates = ['date_voyage'];

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
        return $this->belongsTo(MainOrder::class, 'main_order_id');
    }

    public function voyage()
    {
        return $this->hasOne(Voyage::class, 'id', 'voyage_id');
    }
}
