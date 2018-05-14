<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
