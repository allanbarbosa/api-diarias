<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Funcionario\BuscaFuncionarioPorCpfServico;
use Exception;

class BuscaFuncionarioPorCpfController extends Controller
{
    protected $servico;

    public function __construct(BuscaFuncionarioPorCpfServico $buscaFuncionarioPorCpfServico)
    {
        $this->servico = $buscaFuncionarioPorCpfServico;
    }

    public function show($cpf)
    {
        try {

            $buscaFuncionarioPorCpf = $this->servico->find($cpf);

            return response()->json($buscaFuncionarioPorCpf, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }
}