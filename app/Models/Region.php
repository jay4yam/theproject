<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Region
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ville[] $villes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voyage[] $voyages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property string|null $main_photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereMainPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereUpdatedAt($value)
 */
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
