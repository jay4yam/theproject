<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Voyage extends Model
{
    protected $table ='voyages';

    protected $fillable = ['parent_id', 'title', 'subtitle', 'intro',  'description', 'main_photo', 'price', 'discount_price', 'is_discounted', 'is_public','duree_du_vol', 'ville_id'];

    /**
     * Retourne les voyages en fonction de la valeur de la variable locale
     * @param $query
     * @return mixed
     */
    public function scopeLocalize($query)
    {
        return $query->where('locale', '=', App::getLocale());
    }

    /**
     * Retourne les voyages 'public'
     * @param $query
     * @return mixed
     */
    public function scopeIsPublic($query)
    {
        return $query->where('is_public', '=', 1);
    }

    /**
     * Relation 1:1 entre la table 'voyages' et la table 'villes' (1 voyage à une ville)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id', 'id');
    }

    /**
     * Liens entre la table "blogs" et la table "tags"
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Relation hasManyThrough entre la table 'voyages' et la table 'regions' via la table 'villes"
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function region()
    {
        return $this->hasManyThrough(
            Region::class, // je relie la table 'regions'
            Ville::class, // via la table 'villes'
            'id', // id de la table 'regions'
            'id', // id de la table 'villes'
            'ville_id', // foreign key de la table 'voyages'
            'region_id' // foreign key de la table 'regions'
        );
    }

    /**
     * Relation morph avec la table seo
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function seo()
    {
        return $this->morphMany(Seo::class, 'seotable');
    }
}
