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

    Route::resource('usuario', '\Diarias\Http\Controllers\UsuarioController');
    Route::resource('estado', '\Diarias\Http\Controllers\EstadoController');
    Route::resource('pais', '\Diarias\Http\Controllers\PaisController');
    Route::resource('classe', '\Diarias\Http\Controllers\ClasseController');
    Route::resource('gratificacao', '\Diarias\Http\Controllers\GratificacaoController');
    Route::resource('grupo-internacional', '\Diarias\Http\Controllers\GrupoInternacionalController');
    Route::resource('cargo', '\Diarias\Http\Controllers\CargoController');
    
    Route::put('vinculo-empregaticio/desligar-vinculo-empregaticio', '\Diarias\Http\Controllers\VinculoEmpregaticioController@desligarVinculoEmpregaticio');
    Route::resource('vinculo-empregaticio', '\Diarias\Http\Controllers\VinculoEmpregaticioController');

    Route::resource('lotacao', '\Diarias\Http\Controllers\LotacaoController');
    Route::resource('municipio', '\Diarias\Http\Controllers\MunicipioController');
    Route::resource('unidade', '\Diarias\Http\Controllers\UnidadeController');
    Route::resource('prerrogativa', '\Diarias\Http\Controllers\PrerrogativaController');

    Route::get('organograma/obter-organograma-atual', '\Diarias\Http\Controllers\OrganogramaController@obterOrganogramaAtual');
    Route::get('organograma/obter-sugestao-codigo', '\Diarias\Http\Controllers\OrganogramaController@obterSugestaoCodigo');
    Route::resource('organograma', '\Diarias\Http\Controllers\OrganogramaController');
    
    Route::middleware('criacao.usuario')->post('funcionario', '\Diarias\Http\Controllers\FuncionarioController@store');
    Route::resource('funcionario', '\Diarias\Http\Controllers\FuncionarioController')->only(['index', 'show', 'update']);
    Route::middleware('apagar.usuario')->delete('funcionario/{id}', '\Diarias\Http\Controllers\FuncionarioController@destroy');
    Route::get('dropdown/{slug}', '\Diarias\Http\Controllers\DropdownController@index');

    Route::resource('classe-grupo-internacional', '\Diarias\Http\Controllers\ClasseGrupoInternacionalController');
    Route::resource('comprovacao', '\Diarias\Http\Controllers\ComprovacaoController');
    Route::resource('trecho-roteiro', '\Diarias\Http\Controllers\TrechoRoteiroController');
    Route::resource('tipo-transporte', '\Diarias\Http\Controllers\TipoTransporteController');
    Route::resource('viagem', '\Diarias\Http\Controllers\ViagemController');
    Route::resource('tipo-comprovante', '\Diarias\Http\Controllers\TipoComprovanteController');
    Route::resource('comprovante', '\Diarias\Http\Controllers\ComprovanteController');
    Route::resource('particularidade', '\Diarias\Http\Controllers\ParticularidadeController');
    Route::resource('ferias', '\Diarias\Http\Controllers\FeriasController');
    Route::resource('feriado', '\Diarias\Http\Controllers\FeriadoController');
    Route::resource('status', '\Diarias\Http\Controllers\StatusController');
    Route::resource('perfil', '\Diarias\Http\Controllers\PerfilController');
    Route::resource('parametro', '\Diarias\Http\Controllers\ParametroController');
    Route::resource('empresa', '\Diarias\Http\Controllers\EmpresaController');
    Route::resource('escolaridade', '\Diarias\Http\Controllers\EscolaridadeController');
    Route::resource('historico-movimentacao', '\Diarias\Http\Controllers\HistoricoMovimentacaoController');
    Route::resource('profissao', '\Diarias\Http\Controllers\ProfissaoController');
    Route::resource('funcionario-prerrogativa', '\Diarias\Http\Controllers\FuncionarioPrerrogativaController');
    Route::resource('papel-fluxograma', '\Diarias\Http\Controllers\PapelFluxogramaController');
    Route::resource('movimentacao', '\Diarias\Http\Controllers\MovimentacaoController');
    Route::resource('historico-status', '\Diarias\Http\Controllers\HistoricoStatusController');
    Route::resource('pagamento', '\Diarias\Http\Controllers\PagamentoController');
    Route::get('buscar-funcionario-por-cpf/{cpf}', '\Diarias\Http\Controllers\BuscaFuncionarioPorCpfController@show');
    Route::get('classe-grupo-internacional-por-id-classe/{idClasse}', '\Diarias\Http\Controllers\ObterClasseGrupoInternacionalPorIdClasseController@show');
    Route::get('obter-lotacao-por-matricula/{matricula}', '\Diarias\Http\Controllers\ObterLotacaoPorMatriculaController@show');
    Route::get('obter-lotacao-atual-por-id-funcionario/{idFuncionario}', '\Diarias\Http\Controllers\ObterLotacaoAtualPorIdFuncionarioController@show');


});
