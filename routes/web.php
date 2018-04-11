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

//Login page
Route::get('login',[
    'uses' => 'BdeController@getLogin',
    'as' => 'login']);

//Post Login
Route::post('login', [
    'uses' => 'BdeController@postLogin',
    'as' => 'login.post']);

//Ideas
Route::group(['prefix' => 'ideasbox'], function () { 

    //Index Student Ideas
    Route::get('/', [
        'uses' => 'IdeasBoxController@getIndex',
        'as' => 'ideas.index']);

    //Index Admin Ideas
    Route::get('admin/manage', [
        'uses' => 'IdeasBoxController@getAdminManage',
        'as' => 'ideas.admin.manage']);

    //Handle Like
    Route::get('/{id}/like', [
        'uses' => 'IdeasBoxController@getLikeIndex',
        'as' => 'ideas.like']);

    //Post Student Idea
    Route::post('create', [
        'uses' => 'IdeasBoxController@postCreateIdea',
        'as' => 'ideas.create.post']);

    //Post Admin Idea
    Route::post('admin/create', [
        'uses' => 'IdeasBoxController@postAdminCreateIdea',
        'as' => 'ideas.admin.create.post']);

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
        'as' => 'activities.homepage']);

    //Handle Inscription
    Route::post('signup/{id}', [
        'uses' => 'ActivitiesController@postSignUp',
        'as' => 'activities.signup.post']);

    //Activities Old
    Route::get('past', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.past']);

    //Focus Student Old
    Route::get('focus/{id}', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.focus']);

    //Focus Admin Old
    Route::get('admin/focus/{id}', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.admin.focus']);
});

//Shop
Route::group(['prefix' => 'shop'], function () { 

    //boutique accueil et liste
    Route::get('/', [
        'uses' => 'ShopController@getIndex',
        'as' => 'shop.homepage']);

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