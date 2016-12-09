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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



Route::group(['namespace' => 'Api'], function ($router)
{
    $router->get('users','UserController@index');
    $router->get('article_tags/{id}','ArticleController@similar');
    $router->get('categoryes','CategoryController@index');
    $router->get('templates','TemplateController@index');
});