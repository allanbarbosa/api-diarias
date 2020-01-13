<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\PagamentoRequest;
use Diarias\Pagamento\PagamentoServico;
use Exception;

class PagamentoController extends Controller
{
    protected $servico;

    public function __construct(PagamentoServico $pagamentoServico)
    {
        $this->servico = $pagamentoServico;
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
            
            $pagamento = $this->servico->find($id);

            return response()->json($pagamento, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(PagamentoRequest $request)
    {
        $input = $request->all();
        
        $pagamento = $this->servico->save($input);

        return response()->json($pagamento, 200);
    }

    public function update(PagamentoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $pagamento = $this->servico->update($input, $id);

            return response()->json($pagamento, 200);

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