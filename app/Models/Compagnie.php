<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    protected $table = 'compagnies';

    protected $fillable = [
        'raison_sociale',
        'adresse',
        'code_postal',
        'ville',
        'telephone',
        'email',
        'mail_resa',
        'num_licence',
        'baseline',
        'intro',
        'presentation',
        'logo',
        'background_image'
    ];

    /**
     * Relation N:N de la table compagnie vers la table user via la table pivot 'compagnies_users'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'compagnies_users', 'user_id', 'compagny_id');
    }
}
