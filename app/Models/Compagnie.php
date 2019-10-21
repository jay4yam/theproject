<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Compagnie
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voyage[] $localizedvoyages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voyage[] $voyages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie query()
 * @property int $id
 * @property string $raison_sociale
 * @property string $adresse
 * @property string $code_postal
 * @property string $ville
 * @property string $telephone
 * @property string $email
 * @property string $mail_resa
 * @property string $num_licence
 * @property string $baseline
 * @property string $intro
 * @property string $presentation
 * @property string $logo
 * @property string $background_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereBackgroundImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereBaseline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereMailResa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereNumLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie wherePresentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereRaisonSociale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Compagnie whereVille($value)
 */
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

    /**
     * Relation N:N de la table compagnies vers la table voyages via la table 'compagnies_voyages'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function voyages()
    {
        return $this->belongsToMany(Voyage::class, 'compagnies_voyages', 'compagnies_id',  'voyages_id');
    }

    public function localizedvoyages()
    {
        return $this->belongsToMany(Voyage::class, 'compagnies_voyages', 'compagnies_id',  'voyages_id')->localize();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
