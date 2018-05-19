<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = ['name', 'main_photo'];

    /**
     * Relation entre la table 'regions' et la table 'villes' (1 region à plusieurs ville)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function villes()
    {
        return $this->hasMany(Ville::class, 'region_id', 'id');
    }

    public function voyages()
    {
        return $this->hasManyThrough(
            Voyage::class,
            Ville::class,
            'id',
            'id'
        );
    }


}
