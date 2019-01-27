<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'compagnies_message';

    protected $fillable = [
        'email',
        'visitor_ip',
        'message',
        'compagnie_id'
    ];

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }
}
