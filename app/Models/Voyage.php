<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $table ='voyages';

    protected $fillable = ['title', 'subtitle', 'description', 'main_photo', 'price', 'duree_du_vol', 'ville_id'];

    /**
     * Relation 1:1 entre la table 'voyages' et la table 'villes' (1 voyage appartient à une ville)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ville()
    {
        return $this->hasOne(Ville::class);
    }

    /**
     * Liens entre la table "blogs" et la table "tags"
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
