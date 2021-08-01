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

Route::group([
    'as'        => 'api.', 
    'namespace' => 'App\Http\Controllers\Api'
], function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('sign-up', 'Auth\SignUpController')->name('register');
        Route::post('sign-in', 'Auth\SignInController')->name('login');
        Route::post('send-otp', 'Auth\SendVerificationCodeController')->name('otp.send');
        Route::post('logout', 'Auth\LogoutController')->name('logout');
    });

    Route::group([
        'prefix' => 'cards',
        'middleware' => 'App\Http\Middleware\AuthUser'
    ], function () {
        Route::get('/', 'BankCards\ListController')->name('cards');
        Route::post('/', 'BankCards\CreateController')->name('new.card');
        Route::put('/{id}', 'BankCards\UpdateController')->name('update.card');
        Route::delete('/{id}',  'BankCards\DeleteController')->name('delete.card');
        Route::get('/{id}',  'BankCards\FetchController')->name('card');
    });
});

