<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Autenticacao\AutenticacaoServico;
use Diarias\Http\Requests\AutenticacaoRequest;

class AutenticacaoController extends Controller
{
    protected $servico;

    public function __construct(AutenticacaoServico $autenticacaoServico)
    {
        $this->servico = $autenticacaoServico;
    }

    public function store(AutenticacaoRequest $request)
    {
        try {

            $input = $request->all();

            $servico = $this->servico->autenticar($input);

            return response()->json($servico, 200);

        } catch (\Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
   
}
