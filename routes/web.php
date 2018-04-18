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

//Index
Route::get('/', [
    'uses' => 'BdeController@getIndex',
    'as' => 'index']);

//Ideas
Route::group(['prefix' => 'ideasbox'], function () { 

    //Index Student Ideas
    Route::get('/', [
        'uses' => 'IdeasBoxController@getIndex',
        'as' => 'ideas.index']);
        
    //Handle vote
    Route::get('/{id}/vote', [
        'uses' => 'IdeasBoxController@getVoteIndex',
        'as' => 'ideas.vote']);

    //Handle unvote
    Route::get('/{id}/unvote', [
        'uses' => 'IdeasBoxController@getUnvoteIndex',
        'as' => 'ideas.unvote']);

    //Post Student Idea
    Route::post('create', [
        'uses' => 'IdeasBoxController@postCreateIdea',
        'as' => 'ideas.create.post']);

    //Post Admin Activity
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

    //Handle Inscription
    Route::get('signup/{id}', [
        'uses' => 'ActivitiesController@postSignUp',
        'as' => 'activities.signup.post']);

    //Activities Old
    Route::get('past', [
        'uses' => 'ActivitiesController@getPast',
        'as' => 'activities.past']);

    //Focus
    Route::get('past/{id}', [
        'uses' => 'ActivitiesController@getFocus',
        'as' => 'activities.focus']);

    //List
    Route::get('past/list/{id}', [
        'uses' => 'ActivitiesController@getList',
        'as' => 'activities.list']);
        
    //PostImage
    Route::post('past/{id}/image', [
        'uses' => 'ActivitiesController@postImage',
        'as' => 'activites.focus.image.post'
    ]);

    //HandleLike
    Route::get('past/{id}/like/{imgid}', [
        'uses' => 'ActivitiesController@getLike',
        'as' => 'image.get.like'
    ]);

    //HandleUnlike
    Route::get('past/{id}/unlike/{imgid}', [
        'uses' => 'ActivitiesController@getUnlike',
        'as' => 'image.get.unlike'
    ]);

    //PostComment
    Route::post('past/{id}/comment/{imgid}', [
        'uses' => 'ActivitiesController@postComment',
        'as' => 'image.post.com'
    ]);

    //Uncomment
    Route::get('past/{activityId}/uncomment/{comId}', [
        'uses' => 'ActivitiesController@getUncomment',
        'as' => 'image.post.uncom'
    ]);

    //DeleteImg
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

    //filtr
    Route::post('/', [
        'uses' => 'ShopController@filterProducts',
        'as' => 'shop.index'
    ]);

    //panier
    Route::get('shoppingcart', [
        'uses' => 'ShopController@getShoppingCart',
        'as' => 'shop.shoppingcart']);

    Route::get('addtocart/{productId}', [
        'uses' => 'ShopController@addToShoppingCart',
        'as' => 'shop.addtocart'
    ]);

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