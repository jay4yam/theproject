<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = ['user_id', 'content'];

    /**
     * Relation morph avec les tables 'blogs' et 'voyage'
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function GetRepliedComments($id)
    {
        $val = \Cache::remember('reply-to-'.$id, 20, function () use ($id){
            return Comments::with('user')->where('reply_to', $id)->get();
        });

        return $val;
    }
}
