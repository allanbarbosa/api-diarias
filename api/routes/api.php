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

Route::post('autenticar', '\Diarias\Http\Controllers\AutenticacaoController@store');

Route::group(['middleware' => 'token.validation'], function () {

    Route::get('teste', function () {
        phpinfo();
    });
    
    Route::resource('prerrogativa', '\Diarias\Http\Controllers\PrerrogativaController');
    Route::resource('funcionario', '\Diarias\Http\Controllers\FuncionarioController');
});

