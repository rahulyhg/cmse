<?php

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



Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/', 'HomeController@index');

        Route::resource('users', 'UserController');


        Route::resource('hospitals', 'HospitalController');

        Route::resource('wards', 'WardController');


        Route::resource('items', 'ItemController');
        Route::get('items/{id}/adjustment', ['as' => 'items.adjustment','uses' => 'ItemAdjustmentController@create']);
        Route::post('items/adjustment', ['as' => 'items.adjustment','uses' => 'ItemAdjustmentController@store']);
        route::resource('categories', 'CategoryController');

        Route::get('orders', 'OrderController@index');
        Route::get('orders/{id}', 'OrderController@show');
        Route::get('orders/{id}/approve', 'OrderController@approve');
        Route::get('orders/{id}/deliver', 'OrderController@deliver');
        Route::get('orders/{id}/cancel', 'OrderController@cancel');
        Route::get('orders/{id}/reapprove', 'OrderController@reapprove');

        Route::get('reports/usages','Reports\UsageController@index');
        Route::get('reports/usages/generate', ['as'=>'reports.usages.generate', 'uses' => 'Reports\UsageController@generate']);



    });




});




/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function ()
{
	Route::group(['prefix' => 'v1'], function ()
	{
        require Config::get('generator.path_api_routes');
	});
});










Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
