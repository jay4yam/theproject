<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 14/05/2018
 * Time: 22:00
 */

namespace App\Repositories;


use App\Models\Comments;
use Illuminate\Http\Request;

class CommentRepository
{
    /**
     * @var Comments
     */
    protected $comments;

    /**
     * CommentRepository constructor.
     * @param Comments $comments
     */
    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Retourne la liste des commentaires paginées
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->comments->with(['commentable', 'user'])->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Gère linsertion d'un nouvezu commentaire
     * @param Request $request
     */
    public function store(Request $request)
    {
        $comment = new Comments();

        $this->save($comment, $request);
    }

    /**
     * Gère la sauv. du model
     * @param Comments $comment
     * @param Request $request
     */
    private function save(Comments $comment, Request $request)
    {
        $comment->content = $request->contentComment;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'blog';
        $comment->user_id = $request->user_id;

        if($request->has('reply_to'))
        {
            $comment->reply_to = $request->reply_to;
        }

        $comment->save();

    }

}