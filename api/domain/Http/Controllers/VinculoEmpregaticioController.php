<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\VinculoEmpregaticioRequest;
use Diarias\VinculoEmpregaticio\VinculoEmpregaticioServico;
use Exception;

class VinculoEmpregaticioController extends Controller
{
    protected $servico;

    public function __construct(VinculoEmpregaticioServico $vinculoEmpregaticioServico)
    {
        $this->servico = $vinculoEmpregaticioServico;
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

            $vinculoEmpregaticio = $this->servico->find((int)$id);

            return response()->json($vinculoEmpregaticio, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(VinculoEmpregaticioRequest $request)
    {
        $input = $request->all();

        $vinculoEmpregaticio = $this->servico->save($input);

        return response()->json($vinculoEmpregaticio, 200);
    }

    public function update(VinculoEmpregaticioRequest $request, int $id)
    {
        try {
            
            $input = $request->all();
        
            $vinculoEmpregaticio = $this->servico->update($input, $id);
        
            return response()->json($vinculoEmpregaticio, 200);

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

    public function desligarVinculoEmpregaticio()
    {
        try {
            $idVinculoEmpregaticio = request()->get('idVinculoEmpregaticio');
            $dataDesligamento = request()->get('dataDesligamento');
            $this->servico->desligarVinculoEmpregaticio((int) $idVinculoEmpregaticio, $dataDesligamento);
        } catch (Exception $e) {
            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
}
