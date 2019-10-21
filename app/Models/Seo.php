<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seo
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $seotable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $locale
 * @property string $title
 * @property string $meta_robots
 * @property string $meta_description
 * @property string $canonical
 * @property int $seotable_id
 * @property string $seotable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereMetaRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeotableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeotableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereUpdatedAt($value)
 */
class Seo extends Model
{

    protected $table = 'seotable';

    protected $fillable = ['locale', 'title', 'meta_robots', 'meta_description', 'canonical'];

    /**
     * Get all of the owning seo  models.
     */
    public function seotable()
    {
        return $this->morphTo();
    }


}
