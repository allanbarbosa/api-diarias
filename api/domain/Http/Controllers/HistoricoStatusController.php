<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\HistoricoStatus\HistoricoStatusServico;
use Diarias\Http\Requests\HistoricoStatusRequest;
use Exception;


class HistoricoStatusController extends Controller
{
    protected $servico;

    public function __construct(HistoricoStatusServico $historicoStatusServico)
    {
        $this->servico = $historicoStatusServico;
    }

    public function index()
    {
        $input = request()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show(int $id)
    {
        try {
            
            $historicoStatus = $this->servico->find($id);

            return response()->json($historicoStatus, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(HistoricoStatusRequest $request)
    {
        $input = $request->all();
        
        $historicoStatus = $this->servico->save($input);

        return response()->json($historicoStatus, 200);
    }

    public function update(HistoricoStatusRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $historicoStatus = $this->servico->update($input, $id);

            return response()->json($historicoStatus, 200);

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