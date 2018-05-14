<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials._alternate_href_langue', 'App\Http\ViewComposers\AlternateHrefLangueComposer');
        View::composer('partials._compagnies_select', 'App\Http\ViewComposers\CompagniesSelectComposer');
        View::composer('partials._categories_name', 'App\Http\ViewComposers\BlogCategoriesListingComposer');
        View::composer('partials._three_articles_same_cat', 'App\Http\ViewComposers\ThreeArticlesSameCatComposer');
        View::composer(['back.blog.edit', 'back.blog.create'], 'App\Http\ViewComposers\AllCategoriesComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
