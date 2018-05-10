<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'title','intro','slug','content','main_image','is_public'
    ];

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
}
