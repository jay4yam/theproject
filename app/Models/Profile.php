<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile
 *
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @property int $id
 * @property string $firstName
 * @property string $fullName
 * @property string $birthDate
 * @property string $phoneNumber
 * @property string $address
 * @property string $postalCode
 * @property string $city
 * @property string $country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUserId($value)
 */
class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'fullName', 'birthDate', 'phoneNumber', 'address', 'postalCode', 'city', 'country'
    ];

    /**
     * Relation inverse 1:1 vers la table user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
