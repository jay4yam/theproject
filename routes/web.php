<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['prefix' => '{locale}', 'namespace' => 'Front'], function( ) {
    // Recupère le premier segment de l'url ete definis une valeur par défaut ici le 'FR'
    $locale = Request::segment( 1 ) ? Request::segment( 1 ) : 'fr';

    //Applique la valeur de la variable langue 'locale' au site
    App::setLocale( $locale );

    //Affiche la home page
    Route::get('/', 'HomeController@index')->name('home');
});

//Route regroupant tous les controller présent dans l'admin
//Grace à l'ajout du "namespace', on est pas obligé de préfixer le controller avec 'Back' +'/Controller'
Route::group(['prefix' => '/fr/admin', 'namespace' => 'Back'], function( ) {

    //Listing des routes pour 'CRUD' sur les "Compagnies"
    Route::resource('/compagnies', 'CompagnyController');

    //Listing des routes pour 'CRUD' sur les "Utilisateurs"
    Route::resource('/users', 'UserController');
});