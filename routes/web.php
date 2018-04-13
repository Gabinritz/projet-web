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
        
    //Handle Like
    Route::get('/{id}/like', [
        'uses' => 'IdeasBoxController@getVoteIndex',
        'as' => 'ideas.like']);

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
    Route::get('focus/{id}', [
        'uses' => 'ActivitiesController@getFocus',
        'as' => 'activities.focus']);

    //PostImage

    Route::post('focus/{id}/image', [
        'uses' => 'ActivitiesController@postImage',
        'as' => 'activites.focus.image.post'
    ]);

});

//Shop
Route::group(['prefix' => 'shop'], function () { 

    //boutique accueil et liste
    Route::get('/', [
        'uses' => 'ShopController@getIndex',
        'as' => 'shop.index']);

    //panier
    Route::get('shoppingcart', [
        'uses' => 'ShopController@getShoppingCart',
        'as' => 'shop.shoppingcart']);

    //commander
    Route::get('order', [
        'uses' => 'ShopController@getOrder',
        'as' => 'shop.order']);

    //gestion produit
    Route::get('admin/manage', [
        'uses' => 'ShopController@getAdminManage',
        'as' => 'shop.admin.manage']);

    //post gérer produit
    Route::post('admin/manage', [
        'uses' => 'ShopController@postAdminManage',
        'as' => 'shop.admin.manage.post']);

    //admin créer produit
    Route::get('admin/create', [
        'uses' => 'ShopController@getAdminCreate',
        'as' => 'shop.admin.createe']);

    // post créer produit
    Route::post('admin/create', [
        'uses' => 'ShopController@postAdminCreate',
        'as' => 'shop.admin.create.post']);
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