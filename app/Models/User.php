<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Compagnie[] $compagnie
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Profile $profile
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog[] $blogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MainOrder[] $mainOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemOrder[] $voyagesAchetes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relation 1:1 vers la table profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * Relation 1:1 vers la table customers
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mainOrders()
    {
        return $this->hasMany(MainOrder::class, 'user_id', 'id');
    }

    /**
     * Relation N:N de la table compagnie vers la table user via la table pivot 'compagnies_users'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compagnie()
    {
        return $this->belongsToMany(Compagnie::class, 'compagnies_users', 'user_id', 'compagny_id');
    }

    /**
     * Relation 1:n vers la table blogs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Relation 1:n vers la table comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }


    /**
     * Relation entre la table user et la table itemOrder via la table mainOrder
     */
    public function voyagesAchetes()
    {
        return $this->hasManyThrough(
            ItemOrder::class,
            MainOrder::class,
            'user_id',
            'main_order_id',
            'id',
            'id'
        );
    }
}
