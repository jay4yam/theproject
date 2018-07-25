<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
