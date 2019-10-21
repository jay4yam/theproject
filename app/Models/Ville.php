<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ville
 *
 * @property-read \App\Models\Region $region
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voyage[] $voyages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property string|null $main_photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $region_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereMainPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ville whereUpdatedAt($value)
 */
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

    /**
     * Relation 1:1 vers entre la table 'villes' et la table 'voyages' (1 ville appartient à 1 voyage)
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'ville_id', 'id');
    }
}
