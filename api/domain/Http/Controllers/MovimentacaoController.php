<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\MovimentacaoRequest;
use Diarias\Movimentacao\MovimentacaoServico;
use Exception;

class MovimentacaoController extends Controller
{
    protected $servico;

    public function __construct(MovimentacaoServico $movimentacaoServico)
    {
        $this->servico = $movimentacaoServico;
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
            
            $movimentacao = $this->servico->find($id);

            return response()->json($movimentacao, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(MovimentacaoRequest $request)
    {
        $input = $request->all();
        
        $movimentacao = $this->servico->save($input);

        return response()->json($movimentacao, 200);
    }

    public function update(MovimentacaoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $movimentacao = $this->servico->update($input, $id);

            return response()->json($movimentacao, 200);

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
