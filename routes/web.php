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

use Illuminate\Http\Request;
use App\Idea;
use App\Vote;
use App\Activity;
use App\User;
use App\Storage;

//Index
Route::get('/', [
    'uses' => 'BdeController@getIndex',
    'as' => 'index']);

// [IDEAS] ETUDIANT
Route::delete('/ideas/vote/{id?}', 'IdeasBoxController@unvote');
Route::post('/ideas/vote', 'IdeasBoxController@vote');
Route::post('/ideas/add', 'IdeasBoxController@add');
// [IDEAS] BDE
Route::get('/ideas/{id?}', 'IdeasBoxController@getIdea');
Route::delete('/ideas/{id?}', 'IdeasBoxController@delete');
Route::post('/ideas', 'IdeasBoxController@valid');

// [FOCUS] LIKE
Route::delete('/activities/{id?}/like/{photo?}', 'ActivitiesController@unlike');
Route::post('/activities/{id?}/like/{photo?}', 'ActivitiesController@like');
Route::post('/activities/photos/{photo?}', 'ActivitiesController@comment');
//Ideas
Route::group(['prefix' => 'ideasbox'], function () { 

    //Index Ideée
    Route::get('/', [
        'uses' => 'IdeasBoxController@getIndex',
        'as' => 'ideas.index']);
        
    //Post idée
    Route::post('create', [
        'uses' => 'IdeasBoxController@postCreateIdea',
        'as' => 'ideas.create.post']);

    //Post activité par bde
    Route::post('admin/manage', [
        'uses' => 'IdeasBoxController@postAdminManage',
        'as' => 'ideas.admin.manage.post']);
    
});

//Activities
Route::group(['prefix' => 'activities'], function () { 

    //Index
    Route::get('/', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.index']);

    //iscription pour activité
    Route::get('signup/{id}', [
        'uses' => 'ActivitiesController@postSignUp',
        'as' => 'activities.signup.post']);

    //index activités passées
    Route::get('past', [
        'uses' => 'ActivitiesController@getPast',
        'as' => 'activities.past']);

    //Focus sur ancienne activitée
    Route::get('past/{id}', [
        'uses' => 'ActivitiesController@getFocus',
        'as' => 'activities.focus']);

    //récupérer liste inscrits
    Route::get('past/list/{id}', [
        'uses' => 'ActivitiesController@getList',
        'as' => 'activities.list']);
        
    //poster image pour activité
    Route::post('past/{id}/image', [
        'uses' => 'ActivitiesController@postImage',
        'as' => 'activites.focus.image.post'
    ]);

    //like image activité
    Route::get('past/{id}/like/{imgid}', [
        'uses' => 'ActivitiesController@getLike',
        'as' => 'image.get.like'
    ]);

    //unlike image activité
    Route::get('past/{id}/unlike/{imgid}', [
        'uses' => 'ActivitiesController@getUnlike',
        'as' => 'image.get.unlike'
    ]);

    //commenter image activité
    Route::post('past/{id}/comment/{imgid}', [
        'uses' => 'ActivitiesController@postComment',
        'as' => 'image.post.com'
    ]);

    //supprimer commentaires
    Route::get('past/{activityId}/uncomment/{comId}', [
        'uses' => 'ActivitiesController@getUncomment',
        'as' => 'image.post.uncom'
    ]);

    //supprimer image
    Route::get('past/{activityId}/deleteimg/{imgId}', [
        'uses' => 'ActivitiesController@deleteImg',
        'as' => 'delete.img'
    ]);

    //downlaodPDF
    Route::get('/pdf/{activity}', 
    ['as' => 'list.pdf',
    'uses' => 'ActivitiesController@dwPDF']
    );

    //downlaodCSV
    Route::get('/csv/{activity}', 
    ['as' => 'list.csv',
    'uses' => 'ActivitiesController@dwCSV']
    );

});

//Shop
Route::group(['prefix' => 'shop'], function () { 

    //boutique accueil et liste
    Route::get('/', [
        'uses' => 'ShopController@getIndex',
        'as' => 'shop.index']);

    //filtrer
    Route::post('/', [
        'uses' => 'ShopController@filterProducts',
        'as' => 'shop.index'
    ]);

    //panier
    Route::get('shoppingcart', [
        'uses' => 'ShopController@getShoppingCart',
        'as' => 'shop.shoppingcart']);

    //ajouterProduit
    Route::post('addproduct', [
        'uses' => 'ShopController@addProduct',
        'as' => 'addNewProduct'
    ]);

    //supprimerProduit
    Route::post('deleteproduct', [
        'uses' => 'ShopController@deleteProduct',
        'as' => 'deleteproduct'
    ]);

    //ajouter au panier
    Route::get('addtocart/{productId}', [
        'uses' => 'ShopController@addToShoppingCart',
        'as' => 'shop.addtocart'
    ]);

    //supprimer article du panier
    Route::get('removefromcart/{shoppingCartId}', [
        'uses' => 'ShopController@removeFromShoppingCart',
        'as' => 'shop.removefromcart'
    ]);

    //passer commande
    Route::get('order', [
        'uses' => 'ShopController@getOrder',
        'as' => 'shop.order'
    ]);
});

//gérer le notifs
Route::group(['prefix' => 'notif'], function () { 

//lire la notif
Route::get('readnotif/{notificationId}', [
    'uses' => 'BdeController@notificationRead',
    'as' => 'read.notif'
]);
//signaler photo par cesi
Route::get('reportphoto/{imageId}', [
    'uses' => 'ActivitiesController@reportPhoto',
    'as' => 'report.photo'
]);
//signaler commentaire par cesi
Route::get('reportcomment/{commentId}', [
    'uses' => 'ActivitiesController@reportComment',
    'as' => 'report.comment'
]);

//signaler activité par cesi
Route::get('reportactivity/{activityId}', [
    'uses' => 'ActivitiesController@reportActivity',
    'as' => 'report.activity'
]);

//supprimer activité par bde
Route::get('deleteactivity/{activityId}', [
    'uses' => 'ActivitiesController@deleteActivity',
    'as' => 'delete.activity'
]);
});

//routes d'authentification
Auth::routes();

//Login page
Route::get('login',[
    'uses' => 'BdeController@getLogin',
    'as' => 'login']);
    
//post login
Route::post('login', [
    'uses' => 'SigninController@userSignin',
    'as' => 'logtry']);

//post register
Route::post('register', [
    'uses' => 'SigninController@userRegister',
    'as' => 'registertry'
]);

//logout
Route::get('logout', [
    'uses' => 'SigninController@logout',
    'as' => 'logout'
]);