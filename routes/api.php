<?php

Route::get('login', 'Api\AuthController@login')->name('api.login');

Route::middleware('auth:api')->namespace('Api')->group(function() {
    Route::apiResource('tags', 'TagsController')->except('edit', 'create');
    Route::apiResource('categories', 'CategoriesController')->except('edit', 'create');
    Route::apiResource('users', 'UsersController')->except('edit', 'create');
    Route::apiResource('products', 'ProductsController')->except('edit', 'create');
});
