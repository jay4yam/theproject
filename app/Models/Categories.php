<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Categories
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog[] $blogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog[] $postsPublished
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categories whereUpdatedAt($value)
 */
class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title'];

    /**
     * Relation N:N vers de la table 'categories' vers la table 'blogs'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blogs()
    {
        return$this->belongsToMany(Blog::class, 'blogs_categories', 'categorie_id', 'blog_id');
    }

    /**
     * Relation many/many vers la table blogs en filtrant sur les "articles" où 'is_public' est à 'true"
     * @return mixed
     */
    public function postsPublished()
    {
        return $this->belongsToMany(Blog::class, 'blogs_categories','categorie_id', 'blog_id')->isPublic();
    }
}
