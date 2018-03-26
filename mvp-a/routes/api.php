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


Route::prefix('userContext')
    ->namespace('UserContext')
    ->group(function() {

        Route::prefix('category')
            ->group(function() {

                Route::get('/')
                    ->uses('CategoryController@index')
                    ->name('category.index');

                Route::get('/{id}')
                    ->uses('CategoryController@show')
                    ->name('category.show');

                Route::get('/{id}/books')
                    ->uses('CategoryController@books')
                    ->name('category.books');
                Route::get('/{id}/children')
                    ->uses('CategoryController@children')
                    ->name('category.children');

            });


    });
