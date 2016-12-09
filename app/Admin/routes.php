<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->post('/imgs', 'FileController@imgs');
    $router->resource('users', UserController::class);
    $router->resource('articles', ArticleController::class);
    $router->resource('banners', BannerController::class);
    $router->resource('banner_categories', BannerCategoryController::class);
    $router->resource('categorys', CategoryController::class);
    $router->resource('tags', TagController::class);
    $router->resource('templates', TemplateController::class);
});

