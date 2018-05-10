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
        'id','title','intro','slug','content','main_image','is_public'
    ];

    /**
     * Relation N:N de la table 'blogs' à la table 'categories'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'blogs_categories', 'blog_id', 'categorie_id');
    }
}
