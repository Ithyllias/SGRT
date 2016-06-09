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

Route::group(['middleware' => ['header.manager', 'jwt.auth']], function(){
    Route::get('gestion', ['as' => 'gestion', function () {
        return view('gestion');
    }]);

    Route::get('choix', ['as' => 'choix', function () {
        return view('choix');
    }]);

    Route::get('billes', ['as' => 'billes', function () {
        return view('billes');
    }]);
});

Route::group(['middleware' => ['header.manager', 'jwt.auth', 'coordonator.manager']], function(){
    Route::get('gestion', ['as' => 'coord', function () {
        return view('gestion');
    }]);

    Route::post('gestion/addCours', 'GestionController@addCours');
    Route::post('gestion/addEnseignant', 'GestionController@updateEnseignants');
});

Route::post('billes/getActiveAliases', 'ChoixBillesController@getActiveAliases', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('billes/getBilles', 'ChoixBillesController@getBilles', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('billes/getProfs', 'ChoixBillesController@getProfs', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('choix/getTasks', 'ChoixBillesController@getTasks', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('choix/getChoix', 'ChoixBillesController@getChoix', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('choix/choixStatus', 'ChoixBillesController@choixStatus', ['middleware' => ['jwt.auth', 'header.manager']]);
Route::post('choix/submit', 'ChoixBillesController@submit', ['middleware' => ['jwt.auth', 'header.manager']]);

Route::post('gestion/getCours', 'GestionController@getCours', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);
Route::post('gestion/getEnseignant', 'GestionController@getEnseignant', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);

Route::post('gestion/generateImportForm','ImportController@ImportForm', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);

Route::post('gestion/addNewTask','ImportController@NewTask', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);
Route::post('gestion/completeTask','ImportController@RealTask', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);
Route::post('gestion/initialMarbles','ImportController@StartMarbles', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);

Route::post('gestion/closeTask', 'GestionController@closeTask', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);
Route::post('gestion/unfinished', 'GestionController@getUnfinishedChoices', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);
Route::post('gestion/resetMarbles', 'GestionController@resetMarbles', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);

Route::post('gestion/resetChoice', 'GestionController@resetChoice', ['middleware' => ['jwt.auth', 'header.manager', 'coordonator.manager']]);

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
    Route::any('test', 'GestionController@test');
});
