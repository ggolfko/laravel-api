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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/**
 * API
 */
Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'cors'], 'namespace' => 'Api'], function(){
    Route::resource('auth', 'AuthController', ['only' => ['index']]);
    Route::post('auth', 'AuthController@authenticate');
});

/**
 * apiv2
 */
Route::group(['prefix' => 'api/v2', 'middleware' => ['api'], 'namespace' => 'Api'], function($route) {
    $route->group(['prefix' => 'users'], function($route){
        $route->get('','Controller@index');
        $route->post('add','Controller@store');
        $route->group(['prefix' => '{id}'], function($route){
            $route->get('show','Controller@show');
            $route->post('update','Controller@update');
            $route->post('delete','Controller@destroy');
    		});
    });
});
