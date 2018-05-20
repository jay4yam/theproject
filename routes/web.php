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

    /**
     * Affichage des différentes pages du blog
     */
    Route::get('/blog', 'BlogController@index')->name('blog.index');
    Route::get('/blog/cat/{id}/{categorie}', 'BlogController@categorie')->name('blog.categorie');
    Route::get('/blog/{id}/{slug}', 'BlogController@show')->name('blog.show');
    Route::get('/tag/{id}', 'BlogController@filterByTag')->name('blog.tag');
    Route::get('/blog/search', 'BlogController@search')->name('blog.search');
    //Ajoute un commentaire
    Route::post('/add-comment', 'CommentController@addComment')->name('comment.add');


    /**
     * Affichage des pages voyages
     */
    Route::get('/voyages', 'VoyageController@allVoyages')->name('voyage.index');
    Route::get('/voyage/{id}/{slug}', 'VoyageController@showVoyage')->name('voyage.show');

    //Affichage de la page contact
    Route::get('/contact', 'HomeController@contact')->name('contact');


});

//Route regroupant tous les controller présent dans l'admin
//Grace à l'ajout du "namespace', on est pas obligé de préfixer le controller avec 'Back' +'/Controller'
Route::group(['prefix' => '/fr/admin', 'namespace' => 'Back', 'middleware' => 'auth'], function( ) {

    //Listing des routes pour 'CRUD' sur les "Compagnies"
    Route::resource('/compagnies', 'CompagnyController');

    //Listing des routes pour 'CRUD' sur les "Utilisateurs"
    Route::resource('/users', 'UserController');

    //Listing des resource pour 'CRUD' blog
    Route::resource('/blogs', 'BlogController');

    //Listing des resource pour 'CRUD' blog
    Route::resource('/comments', 'CommentController');

    //Listing des resource pour 'CRUD' un voyage
    Route::resource('/voyages', 'VoyageController');
});