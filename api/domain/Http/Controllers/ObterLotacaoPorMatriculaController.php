<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\VinculoEmpregaticio\ObterLotacaoPorMatriculaServico;
use Exception;

class ObterLotacaoPorMatriculaController extends Controller
{
    protected $servico;

    public function __construct(ObterLotacaoPorMatriculaServico $obterLotacaoPorMatriculaServico)
    {
        $this->servico = $obterLotacaoPorMatriculaServico;
    }

    public function show($matricula)
    {
        try {

            $obterLotacaoPorMatricula = $this->servico->find($matricula);

            return response()->json($obterLotacaoPorMatricula, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

}