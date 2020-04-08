<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrapUrl extends Model
{
    protected $table = 'scrap';

    public bool $timestamps = true;

    public function compagnie(){
        return $this->belongsTo(Compagnie::class);
    }

    public function voyage(){
        return $this->belongsTo(Voyage::class);
    }
}
