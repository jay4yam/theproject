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
