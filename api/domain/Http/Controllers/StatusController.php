<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\StatusRequest;
use Diarias\Status\StatusServico;
use Exception;

class StatusController extends Controller
{
    protected $servico;

    public function __construct(StatusServico $statusServico)
    {
        $this->servico = $statusServico;
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
            
            $status = $this->servico->find($id);

            return response()->json($status, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(StatusRequest $request)
    {
        $input = $request->all();
        
        $status = $this->servico->save($input);

        return response()->json($status, 200);
    }

    public function update(StatusRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $status = $this->servico->update($input, $id);

            return response()->json($status, 200);

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
