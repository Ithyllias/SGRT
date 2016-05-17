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
ini_set('xdebug.max_nesting_level', 500);

Route::group([], function(){
    Route::get('gestion', ['as' => 'gestion', ['middleware' => ['jwt.auth', 'header.manager']], function () {
        return view('gestion');
    }]);

    Route::get('choix', ['as' => 'choix', ['middleware' => ['jwt.auth', 'header.manager']], function () {
        return view('choix');
    }]);
    
    Route::post('choix/getTasks', 'ChoixService@getTasks', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('choix/getChoix', 'ChoixService@getChoix', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('choix/choixStatus', 'ChoixService@choixStatus', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('choix/submit', 'ChoixService@submit', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('choix/test', 'ChoixService@getChoix', ['middleware' => ['jwt.auth', 'header.manager']]);
    
    Route::get('billes', ['as' => 'billes', ['middleware' => ['jwt.auth', 'header.manager']], function () {
        return view('billes');
    }]);
    Route::post('billes/getBilles', 'BillesService@getBilles', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('billes/getProfs', 'BillesService@getProfs', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('billes/test', 'BillesService@test', ['middleware' => ['jwt.auth', 'header.manager']]);

    Route::get('gestion', ['as' => 'coord', ['middleware' => ['jwt.auth', 'header.manager']], function () {
        return view('gestion');
    }]);
    
    Route::post('gestion/addCours', 'CoordService@addCours', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('gestion/getCours', 'CoordService@getCours', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('gestion/addEnseignant', 'CoordService@addEnseignant', ['middleware' => ['jwt.auth', 'header.manager']]);
    Route::post('gestion/getEnseignant', 'CoordService@getEnseignant', ['middleware' => ['jwt.auth', 'header.manager']]);
});
Route::group([], function(){
    Route::get('/home', ['as' => 'home', function () {
        return view('home');
    }]);
    Route::get('changeLang/{locale}', function ($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    });
    Route::get('/', 'LdapAuthController@getLogin');
    Route::post('/login', 'LdapAuthController@postLogin');
    Route::post('/login/authenticate', 'LdapAuthController@authenticate');
    Route::any('/logout', 'LdapAuthController@getLogout');
    Route::any('test', 'ChoixService@test');
});
