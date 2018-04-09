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
Route::get('/', function () { 
    return view('welcome');
});
//page inscription/connexion
Route::get('login', function () { 
        return view('welcome');
});
//handle inscription
Route::post('login', function () { 
    return view('welcome');
});
//boite a idées
Route::group(['prefix' => 'ideasbox'], function () { 
    //accueil
    Route::get('/', function() { 
        
    });
    //liste
    Route::get('list', function() {

    }); 
    //créer idée
    Route::post('create', function() { 

    });
    //créer idée par admin
    Route::get('admin/create', function() { 

    });
    //post idée par admin
    Route::post('admin/create', function () { 

});
    //voir list idées par admin
    Route::get('admin/manage', function() { 

    });
    //en faire une activité
    Route::post('admin/manage', function() { 

    });
    
});
//activités
Route::group(['prefix' => 'activitie'], function () { 
    //accueil
    Route::get('/', function() {

    });
    //liste
    Route::get('liste', function() { 

    });
    //s'inscrire
    Route::post('signup/{id}', function() { 

    });
    //liste anciennes
    Route::get('past', function() { 

    });
    //focus sur ancienne
    Route::get('focus/{id}', function() { 

    });
    //focus sur activité par admin
    Route::get('admin/focus/{id}', function() { 

    });
});
//boutique
Route::group(['prefix' => 'shop'], function () { 
    //boutique accueil et liste
    Route::get('/', function() { 

    });
    //panier
    Route::get('shoppingcart', function() { 

    });
    //commander
    Route::get('order', function() { 

    });
    //gestion produit
    Route::get('admin/manage', function() { 

    });
    //admin créer produit
    Route::get('create', function() { 

    });
});