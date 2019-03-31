<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

// Route::group(['middleware' => 'auth:api'], function(){
//     Route::post('details', 'API\UserController@details');
//     Route::resource('empresa', 'API\EmpresaController');
 
// });

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');

    Route::get('empresa', 'API\EmpresaController@index');
    Route::get('empresa/{id}', 'API\EmpresaController@show');
    Route::post('empresa', 'API\EmpresaController@store');
    Route::match(['put', 'patch', 'post'], 'empresa/{id}', 'API\EmpresaController@update');
    Route::delete('empresa/{id}', 'API\EmpresaController@destroy');
 
});