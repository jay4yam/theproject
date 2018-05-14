<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 10/05/2018
 * Time: 22:09
 */

namespace App\Http\ViewComposers;

use App\Models\Blog;
use Illuminate\View\View;

class ThreeArticlesSameCatComposer
{
    /**
     * @var Blog
     */
    protected $blog;

    /**
     * ThreeArticlesSameCatComposer constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function get3lastArticles($id)
    {
        $value = \Cache::remember('last3articles', 100, function () use ($id){
            return $this->blog->isPublic()->where('id', '!=', $id)->orderBy('created_at', 'desc')->with('user')->limit(3)->get();
        });

        return $value;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $path = app('request')->path();

        $array = explode('/', $path);

        $view->with('articles', $this->get3lastArticles($array[2]) );
    }
}