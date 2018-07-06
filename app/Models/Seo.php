<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{

    protected $table = 'seotable';

    /**
     * Get all of the owning seo  models.
     */
    public function seotable()
    {
        return $this->morphTo();
    }


}
