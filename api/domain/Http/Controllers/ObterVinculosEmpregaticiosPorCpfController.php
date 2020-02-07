<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;

use Diarias\VinculoEmpregaticio\ObterVinculosEmpregaticiosPorCpfServico;
use Exception;

class ObterVinculosEmpregaticiosPorCpfController extends Controller
{
    protected $servico;

    public function __construct(ObterVinculosEmpregaticiosPorCpfServico $obterVinculosEmpregaticiosPorCpfServico)
    {
        $this->servico = $obterVinculosEmpregaticiosPorCpfServico;
    }

    public function show($cpf)
    {
        try {
            
            $obterVinculosEmpregaticiosPorCpf = $this->servico->find($cpf);
            
            return response()->json($obterVinculosEmpregaticiosPorCpf, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

}