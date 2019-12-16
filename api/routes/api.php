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
    Route::resource('usuario', '\Diarias\Http\Controllers\UsuarioController')->only(['index', 'show', 'store', 'update']);
    Route::resource('estado', '\Diarias\Http\Controllers\EstadoController');
    Route::resource('classe', '\Diarias\Http\Controllers\ClasseController');
    Route::resource('prerrogativa', '\Diarias\Http\Controllers\PrerrogativaController');
    Route::middleware('criacao.usuario')->post('funcionario', '\Diarias\Http\Controllers\FuncionarioController@store');
    Route::resource('funcionario', '\Diarias\Http\Controllers\FuncionarioController')->only(['index', 'show', 'update']);
    // Route::delete('funcionario/{funcionario}', '\Diarias\Http\Controllers\FuncionarioController@destroy')->middleware('deletar.usuario');
    Route::get('dropdown/{slug}', '\Diarias\Http\Controllers\DropdownController@index');

});

