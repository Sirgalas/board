<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'api.', 'namespace' => 'Api'],
    function () {
        Route::get('/', 'HomeController@home');
        Route::post('/register', 'Auth\RegisterController@register');
        Route::post('/login', 'Auth\LoginController@login');

        Route::middleware('auth:api')->group(function () {
            Route::resource('adverts', 'Adverts\AdvertController')->only('index', 'show');
            Route::post('/adverts/{advert}/favorite', 'Adverts\FavoriteController@add');
            Route::delete('/adverts/{advert}/favorite', 'Adverts\FavoriteController@remove');

            Route::group(
                [
                    'prefix' => 'user',
                    'as' => 'user.',
                    'namespace' => 'User',
                ],
                function () {
                    Route::get('/', 'ProfileController@show');
                    Route::put('/', 'ProfileController@update');
                    Route::get('/favorites', 'FavoriteController@index');
                    Route::delete('/favorites/{advert}', 'FavoriteController@remove');

                    Route::resource('adverts', 'AdvertsController')->only('index', 'show', 'update', 'destroy');
                    Route::post('/adverts/create/{category}/{region?}', 'AdvertsController@store');

                    Route::put('/adverts/{advert}/photos', 'AdvertsController@photos');
                    Route::put('/adverts/{advert}/attributes', 'AdvertsController@attributes');
                    Route::post('/adverts/{advert}/send', 'AdvertsController@send');
                    Route::post('/adverts/{advert}/close', 'AdvertsController@close');
                }
            );
        });
    });
