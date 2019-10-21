<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Voyage
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Compagnie[] $compagnies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Region[] $region
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Seo[] $seo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\Ville $ville
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage isPublic()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage langues()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage localize()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $locale
 * @property int $parent_id
 * @property string $title
 * @property string $subtitle
 * @property string $intro
 * @property string $description
 * @property string $main_photo
 * @property float $price
 * @property float|null $discount_price
 * @property int $is_discounted
 * @property int $is_public
 * @property string $duree_du_vol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ville_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereDureeDuVol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereIsDiscounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereMainPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voyage whereVilleId($value)
 */
class Voyage extends Model
{
    protected $table ='voyages';

    protected $fillable = [
        'parent_id',
        'title',
        'subtitle',
        'intro',
        'description',
        'main_photo',
        'price',
        'discount_price',
        'is_discounted',
        'is_public',
        'duree_du_vol',
        'ville_id',
        'locale'];

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
     * Retourne les voyages disposant d'une langue
     * @param $query
     * @return mixed
     */
    public function scopeLangues($query)
    {
        //1. cherche les row qui ont le même id que l'objet voyage
        $voyagesLangues = $query->where('parent_id', '=', $this->id);

        //2. retourne le résultat sous forme de tableau
        return $voyagesLangues->get(['locale'])->toArray();
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

    /**
     * Relation N:N de la table compagnies vers la table voyages via la table 'compagnies_voyages'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compagnies()
    {
        return $this->belongsToMany(Compagnie::class, 'compagnies_voyages', 'voyages_id',  'compagnies_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
}
