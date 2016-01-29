<?php

use App\Http\Controllers\FrontController;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id', '[1-9][0-9]*');
//Route::pattern('slug', '\w*');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'FrontController@index']);
    Route::get('prod/{id}/{slug}', 'FrontController@showProduct');
    Route::get('cat/{id}/{slug?}', 'FrontController@showProductByCategory');
    Route::get('tag/{id}/{slug?}', 'FrontController@showProductByTag');
    Route::get('contact', 'FrontController@showContact');
    Route::post('storeContact', 'FrontController@storeContact');
    Route::post('addCart', 'FrontController@addCart');
    Route::get('viewCart', 'FrontController@viewCart');
    Route::get('removeCart/{id}', 'FrontController@removeCart');
    Route::get('decrementProductInCart/{id}', 'FrontController@decrementProductInCart');
    Route::get('incrementProductInCart/{id}', 'FrontController@incrementProductInCart');

    Route::group(['middleware' => ['throttle:60,1']], function ()
    { // 60 tentatives sur une minutes
        Route::any('login', 'LoginController@login');
        Route::any('logout', 'LoginController@logout');
    });

    Route::group(['middleware' => ['auth', 'admin']], function()
    {
        Route::get('admin', 'admin\AdminController@index');
        Route::resource('admin/product', 'admin\ProductController');
        Route::get('admin/product/status/{id}', 'admin\ProductController@changeStatus');
        Route::get('admin/commandList', 'admin\CommandController@commandList');
        Route::get('admin/commandDetail/{id}', 'admin\CommandController@commandDetail');
    });

    Route::group(['middleware' => ['auth']], function()
    {
        Route::get('confirmCart', 'FrontController@confirmCart');
        Route::get('finalizeCart', 'FrontController@finalizeCart');
    });

});

//Exemple d'utilisation d'une route seule avec un middleware
//Route::get('test', ['middleware' => ['admin'], function() {
//    return 'hello word';
//}]);


