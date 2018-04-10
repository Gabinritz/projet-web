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

Route::get('/', function () { //homepage
    return view('welcome');
});

Route::get('login', function () { //page inscription/connexion
        return view('login');
});

Route::group(['prefix' => 'ideasbox'], function () { //boite a idées
    
    Route::get('/', function() { //accueil
            
    });
    
    Route::get('list', function() { //liste

    }); 

    Route::get('create', function() { //créer idée

    });
});

Route::group(['prefix' => 'activitie'], function () { //activitées
   
    Route::get('/', function() { //accueil

    });

    Route::get('liste', function() { //liste

    });
    
    Route::get('signup/{id}', function() { //s'inscrire

    });

    Route::get('past', function() { //liste anciennes

    });

    Route::get('focus/{id}', function() { //focus sur ancienne

    });
});

Route::group(['prefix' => 'shop'], function () { //boutique
    
    Route::get('/', function() { //boutique accueil et liste

    });

    Route::get('shoppingcart', function() { //panier

    });

    Route::get('order', function() { //commander

    });

    Route::get('admin/manage', function() { //gestion produit

    });
});