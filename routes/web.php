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
        return view('login');
});
//handle inscription
Route::post('login', function () { 
    return redirect()->route('welcome');
});
//boite a idées
Route::group(['prefix' => 'ideasbox'], function () { 
    //accueil
    Route::get('/', function() { 
        return view('ideas-box.student.homepage');
    });
    //liste
    Route::get('list', function() {
        return view('ideas-box.student.list');
    }); 
    //créer idée
    Route::post('create', function() { 
        return view('ideas-box.student.create');
    });
    //post idée par student 
    Route::post('create', function() { 
        return redirect()->route('ideas-box.student.create');
    });
    //créer idée par admin
    Route::get('admin/create', function() { 
        return view('ideas-box.admin.create');
    });
    //post idée par admin
    Route::post('admin/create', function () { 
        return redirect()->route('ideas-box.admin.create');
});
    //voir list idées par admin
    Route::get('admin/manage', function() { 
        return view('ideas-box.admin.manage');
    });
    //en faire une activité
    Route::post('admin/manage', function() { 
        return redirect()->route('ideas-box.admin.manage');
    });
    
});
//activités
Route::group(['prefix' => 'activitie'], function () { 
    //accueil
    Route::get('/', function() {
        return view('activities.student.homepage');
    });
    //liste
    Route::get('liste', function() { 
        return view('activities.student.list');
    });
    //s'inscrire
    Route::post('signup/{id}', function() { 
        return redirect()->route('activities.student.list');
    });
    //liste anciennes
    Route::get('past', function() { 
        return view('activities.student.past');
    });
    //focus sur ancienne
    Route::get('focus/{id}', function() { 
        return view('activities.student.focus');
    });
    //focus sur activité par admin
    Route::get('admin/focus/{id}', function() { 
        return view('activities.admin.past');
    });
});
//boutique
Route::group(['prefix' => 'shop'], function () { 
    //boutique accueil et liste
    Route::get('/', function() { 
        return view('shop.student.homepage');
    });
    //panier
    Route::get('shoppingcart', function() { 
        return view('shop.student.shoppingcart');
    });
    //commander
    Route::get('order', function() { 
        return view('shop.student.order');
    });
    //gestion produit
    Route::get('admin/manage', function() { 
        return view('shop.admin.manage');
    });
    //post gérer produit
    Route::get('admin/manage', function() { 
        return redirect()->route('shop.admin.manage');
    });
    //admin créer produit
    Route::get('admin/create', function() { 
        return view('shop.admin.create');
    });
    // post créer produit
    Route::post('admin/create', function() { 
        return redirect()->route('shop.student.homepage');
    });

});