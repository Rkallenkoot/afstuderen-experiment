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
    ->name('userContext.')
    ->namespace('UserContext')
    ->group(function() {

        Route::prefix('category')
            ->group(function() {

                Route::get('/', 'CategoryController@index')
                    ->name('category.index');

                Route::get('/{category}', 'CategoryController@show')
                    ->name('category.show');

                Route::get('/{category}/books', 'CategoryController@books')
                    ->name('category.books');

                Route::get('/{category}/children', 'CategoryController@children')
                    ->name('category.children');

            });


    });
