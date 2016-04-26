<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group([], function(){
    Route::get('/', 'LdapAuthController@getLogin');
    Route::post('/login', 'LdapAuthController@postLogin');
    Route::get('/home', ['as' => 'home', function () {
        return view('home');
    }]);
    Route::get('billes', ['as' => 'billes', function () {
        return view('billes');
    }]);
    Route::get('gestion', ['as' => 'gestion', function () {
        return view('gestion');
    }]);
    Route::get('changeLang/{locale}', function ($locale) {
        return redirect()->back()->with('newLang', $locale);
    });

    // Group for choix routes
    Route::group([], function() {
        Route::any('choix', ['as' => 'choix', function () {
            return view('choix');
        }]);
        Route::get('choix/getTasks', 'ChoixService@getTasks');
        Route::post('choix/getChoix', 'ChoixService@getChoix');
        Route::post('choix/choixStatus', 'ChoixService@choixStatus');
        Route::post('choix/submit', 'ChoixService@submit');
        Route::post('choix/test', 'ChoixService@getChoix');
    });
});
