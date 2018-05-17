<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'villes';

    protected $fillable = ['name', 'latitude', 'longitude'];

    /**
     * Relation entre la table 'ville' et la table 'regions' (1 ville appartient à 1 region)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
