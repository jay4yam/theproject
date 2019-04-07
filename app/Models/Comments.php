<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = ['user_id', 'content', 'reply_to', 'commentable_id', 'commentable_type', 'genre_avatar', 'main_order_id', 'user_name_for_comment'];

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
