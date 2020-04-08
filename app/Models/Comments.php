<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comments
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $commentable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $content
 * @property int|null $reply_to
 * @property int $commentable_id
 * @property string $commentable_type
 * @property string $genre_avatar
 * @property string|null $main_order_id
 * @property string|null $user_name_for_comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereGenreAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereMainOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereReplyTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments whereUserNameForComment($value)
 */
class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'content', 'reply_to', 'commentable_id', 'commentable_type', 'genre_avatar', 'main_order_id',
        'user_name_for_comment'
    ];

    /**
     * Relation morph avec les tables 'blogs' et 'voyage'
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Relation 1:n vers la table user (1 commentaire appartient à un utilisateur)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Retourne la liste des reply d'un commentaire
     * @param $id
     * @return mixed
     */
    public function GetRepliedComments($id)
    {
        $val = \Cache::remember('reply-to-'.$id, 20, function () use ($id){
            return Comments::with('user')->where('reply_to', $id)->get();
        });

        return $val;
    }

}
