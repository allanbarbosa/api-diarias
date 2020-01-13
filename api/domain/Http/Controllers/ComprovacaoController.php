<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Comprovacao\ComprovacaoServico;
use Diarias\Http\Requests\ComprovacaoRequest;
use Exception;


class ComprovacaoController extends Controller
{
    protected $servico;

    public function __construct(ComprovacaoServico $comprovacaoServico)
    {
        $this->servico = $comprovacaoServico;
    }

    public function index()
    {
        $input = request()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show($id)
    {
        try {
            
            $comprovacao = $this->servico->find($id);

            return response()->json($comprovacao, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ComprovacaoRequest $request)
    {
        $input = $request->all();
        
        $comprovacao = $this->servico->save($input);

        return response()->json($comprovacao, 200);
    }

    public function update(ComprovacaoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $comprovacao = $this->servico->update($input, $id);

            return response()->json($comprovacao, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try {

            $usuario = request()->get('usuario');

            $this->servico->delete($id, (int)$usuario);

            return response()->json('Registro excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
}