<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;


use Diarias\VinculoEmpregaticio\ObterLotacaoAtualPorIdFuncionarioServico;
use Exception;

class ObterLotacaoAtualPorIdFuncionarioController extends Controller
{
    protected $servico;

    public function __construct(ObterLotacaoAtualPorIdFuncionarioServico $obterLotacaoAtualPorIdFuncionarioServico)
    {
        $this->servico = $obterLotacaoAtualPorIdFuncionarioServico;
    }

    public function show(int $idFuncionario)
    {
        try {

            $obterLotacaoAtualPorIdFuncionario = $this->servico->find($idFuncionario);

            return response()->json($obterLotacaoAtualPorIdFuncionario, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

}