<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog[] $blogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voyage[] $voyages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 */
class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    /**
     * Return relation many to many morph entre les tables tags et blogs
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }

    /**
     * Relation many to many morph entre les tables tags et voyages
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function voyages()
    {
        return $this->morphedByMany(Voyage::class, 'taggable');
    }
}
