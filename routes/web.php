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

Route::group(['prefix' => '{locale}', 'namespace' => 'Front', 'middleware' => 'locale'], function( ) {
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
    Route::get('/voyages', 'VoyageController@allVoyages')->name('front.voyage.index');
    Route::get('/voyage/{id}/{slug}', 'VoyageController@showVoyage')->name('front.voyage.show');
    //vue filtre par ville
    Route::get('/voyages/ville', 'VoyageController@filterVille')->name('front.voyage.ville');
    Route::get('/voyages/price', 'VoyageController@filterPrice')->name('front.voyage.price');

    //Affichage de la page contact
    Route::get('/contact', 'HomeController@contact')->name('contact');


});

//Route regroupant tous les controller présent dans l'admin
//Grace à l'ajout du "namespace', on est pas obligé de préfixer le controller avec 'Back' +'/Controller'
Route::group(['prefix' => '/fr/admin', 'namespace' => 'Back', 'middleware' => 'auth'], function( ) {

    Route::get('/', 'AdminController@index')->name('back.index');

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
    Route::post('/voyages/miniatures', 'VoyageController@uploadMiniature')->name('voyages.upload.miniature');
    Route::get('/delete-miniature','VoyageController@deleteMiniature' );

    Route::resource('villes', 'VilleController');
    Route::resource('regions', 'RegionController');
});


Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function(){
    Route::get('/voyage-get-list-voyage', 'VoyageFrontController@getVoyagesListForAutocomplete');
    Route::get('/voyage-info', 'VoyageFrontController@getVoyagesInfoForCart');
    Route::post('/add-voyage-to-cart', 'VoyageFrontController@addVoyageToCart')->name('add.to.cart.voyage');
    Route::get('/removefromcart','VoyageFrontController@removeFromCart');
    Route::get('/update-quantity', 'VoyageFrontController@updateQuantity' );
});