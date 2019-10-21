<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Categories[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog isPublic()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog localize()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $locale
 * @property int|null $parent_id
 * @property string $title
 * @property string $intro
 * @property string $slug
 * @property string $content
 * @property string $main_image
 * @property int $is_public
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereUserId($value)
 */
class Blog extends Model
{
    protected $table = 'blogs';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'locale', 'parent_id','title','intro','slug','content','main_image','is_public', 'user_id'
    ];

    /**
     * Retourne les articles en fonction de la valeur de la variable locale
     * @param $query
     * @return mixed
     */
    public function scopeLocalize($query)
    {
        return $query->where('locale', '=', \App::getLocale());
    }

    /**
     * Récupère les articles "visibles"
     * @param $query
     * @return mixed
     */
    public function scopeIsPublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Relation N:1 vers la table user (1 article à un seul propriétaire user')
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation N:N de la table 'blogs' à la table 'categories'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'blogs_categories', 'blog_id', 'categorie_id');
    }

    /**
     * Relation vers la table comments
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
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
