<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 09/05/2018
 * Time: 23:42
 */

namespace App\Repositories;


use App\Models\Blog;

class BlogRepository
{
    /**
     * @var Blog
     */
    protected $blog;

    /**
     * BlogRepository constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function getById($id)
    {

    }

    /**
     * Retourne les articles paginés par 10 ordonnés par date
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->blog->with('user', 'categories')->orderBy('created_at', 'DESC')->paginate(10);
    }
}