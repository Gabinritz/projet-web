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
//homepage
Route::get('/', [
    'uses' => 'BdeController@getIndex',
    'as' => 'index']);

//page inscription/connexion
Route::get('login',[
    'uses' => 'BdeController@getLogin',
    'as' => 'login']);

//handle inscription
Route::post('login', [
    'uses' => 'BdeController@postLogin',
    'as' => 'login.post']);

//boite a idées
Route::group(['prefix' => 'ideasbox'], function () { 

    //accueil
    Route::get('/', [
        'uses' => 'IdeasBoxController@getIndex',
        'as' => 'ideas.index']);

    //liste
    Route::get('list', [
        'uses' => 'IdeasBoxController@getList',
        'as' => 'ideas.list']);

    //créer idée
    Route::post('create', [
        'uses' => 'IdeasBoxController@postCreateIdea',
        'as' => 'ideas.create.post']);

    //post idée par student 
    Route::post('create', [
        'uses' => 'IdeasBoxController@postCreateIdea',
        'as' => 'ideas.create.post']);
    
    //créer idée par admin
    Route::get('admin/create', [
        'uses' => 'IdeasBoxController@getAdminCreateIdea',
        'as' => 'ideas.admin.create']);

    //post idée par admin
    Route::post('admin/create', [
        'uses' => 'IdeasBoxController@postAdminCreateIdea',
        'as' => 'ideas.admin.create.post']);

    //voir list idées par admin
    Route::get('admin/manage', [
        'uses' => 'IdeasBoxController@getAdminManage',
        'as' => 'ideas.admin.manage']);

    //en faire une activité
    Route::post('admin/manage', [
        'uses' => 'IdeasBoxController@postAdminManage',
        'as' => 'ideas.admin.manage.post']);
    
});

//activités
Route::group(['prefix' => 'activities'], function () { 

    //accueil
    Route::get('/', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.homepage']);

    //liste
    Route::get('list', [
        'uses' => 'ActivitiesController@getList',
        'as' => 'activities.list']);

    //s'inscrire
    Route::post('signup/{id}', [
        'uses' => 'ActivitiesController@postSignUp',
        'as' => 'activities.signup.post']);

    //liste anciennes
    Route::get('past', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.past']);

    //focus sur ancienne
    Route::get('focus/{id}', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.focus']);

    //focus sur activité par admin
    Route::get('admin/focus/{id}', [
        'uses' => 'ActivitiesController@getIndex',
        'as' => 'activities.admin.focus']);
});

//boutique
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