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

use App\Mail\mainOrderMailable;
use App\Models\MainOrder;

Auth::routes();

Route::group(['prefix' => '{locale}', 'namespace' => 'Front', 'middleware' => 'locale'], function( ) {
    //Applique la valeur de la variable langue 'locale' au site
    App::setLocale( 'fr' );

    /**
     * Affiche la home page
     */
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
    Route::get('/voyages-en-helicoptere', 'VoyageController@allVoyages')->name('front.voyage.index');
    Route::get('/voyage/{id}/{slug}', 'VoyageController@showVoyage')->name('front.voyage.show');

    //vue filtre par ville
    Route::get('/voyages/filter', 'VoyageController@filterVille')->name('front.voyage.ville');
    Route::get('/price', 'VoyageController@filterPrice')->name('front.voyage.price');

    Route::get('/helicoptere/{ville}/{id}', 'VoyageController@showVille')->name('front.voyage.show.ville');

    /**
     * Affichage page compagnie
     */
    Route::get('/compagnie/{id}/{companyName}', 'CompagnieController@show')->name('compagnie.front.show');
    Route::post('/compagnie/contact/form', 'CompagnieController@contactCompagnie')->name('compagnie.contact.form');

    //Affichage de la page contact
    Route::get('/contact', 'HomeController@contact')->name('contact');

    //Affichage de la page cart-step-1
    Route::get('/cart/step-1','CartController@showCart')->name('cart.step1');
    Route::post('/charge', 'CartController@charge')->name('cart.charge');
    Route::get('/thank/{orderId}', 'CartController@thank')->name('cart.thank');

    Route::post('/newsletter-subscribe', 'NewsletterController@subscribe')->name('newsletter.subscribe');

    Route::get('/add/testimonials/{order_id}/{voyage_id}', 'CommentController@addTestimonials')->name('add.testimonials');
    Route::post('/post/testimonials', 'CommentController@postTestimonials')->name('post.testimonials');

});

/**
 * Route regroupant tous les controller présent dans l'admin
 * Grace à l'ajout du "namespace', on est pas obligé de préfixer le controller avec 'Back' +'/Controller'
 */
Route::group(['prefix' => '/fr/admin', 'namespace' => 'Back', 'middleware' => 'auth'], function( ) {

    Route::get('/', 'AdminController@index')->name('back.index');

    //Listing des routes pour 'CRUD' sur les "compagnies"
    Route::resource('/compagnies', 'CompagnyController');

    //Listing des routes pour le scrap des url
    Route::resource('/scrap', 'ScrapController');

    //Gère l'upload d'un csv pour scrapper le site
    Route::post('scrapfile/upload', 'ScrapController@uploadScrapeFile')->name('scrap.upload');

    //Gère le scrapp des voyages pour une compagnie
    Route::get('/scrapfile/scrapping', 'ScrapController@scrapeData')->name('scrap.scraping');

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

    Route::resource('seo', 'SeoController');
});

/**
 * Routes des requêtes en AJAX
 */
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function(){
    Route::get('/voyage-get-list-voyage', 'VoyageFrontController@getVoyagesListForAutocomplete');
    Route::get('/voyage-info', 'CartController@getVoyagesInfoForCart');
    Route::post('/add-voyage-to-cart', 'CartController@addVoyageToCart')->name('add.to.cart.voyage');
    Route::get('/removefromcart','CartController@removeFromCart');
    Route::get('/update-quantity', 'CartController@updateQuantity' );
    //requete ajax pour recup les infos de chaque commandes
    Route::get('/items-order-info', 'CommandeController@ajaxGetItemsOrderInfo');
});