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

Route::get('/', function () {
    return view('welcome');
});
Route::any('choix', ['as' => 'choix', function () {
    return view('choix');
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
Route::get('choix/getTasks', 'ChoixService@getTasks');
Route::get('choix/test', function(){
    return "test";
});
Route::get('test', 'ChoixService@getTasks');
