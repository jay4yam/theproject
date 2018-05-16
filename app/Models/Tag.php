<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
