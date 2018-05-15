<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 14/05/2018
 * Time: 22:00
 */

namespace App\Repositories;


use App\Models\Comments;

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
        return $this->comments->with('commentable', 'user')->orderBy('created_at', 'desc')->paginate(10);
    }
}