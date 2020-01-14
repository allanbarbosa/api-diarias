<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;
use App\Http\Controllers\Controller;
use Diarias\Http\Requests\TipoTransporteRequest;
use Diarias\TipoTransporte\TipoTransporteServico;
use Exception;


class TipoTransporteController extends Controller
{
    protected $servico;

    public function __construct(TipoTransporteServico $tipoTransporteServico)
    {
        $this->servico = $tipoTransporteServico;
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
            
            $tipoTransporte = $this->servico->find($id);

            return response()->json($tipoTransporte, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(TipoTransporteRequest $request)
    {
        $input = $request->all();
        
        $tipoTransporte = $this->servico->save($input);

        return response()->json($tipoTransporte, 200);
    }

    public function update(TipoTransporteRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $tipoTransporte = $this->servico->update($input, $id);

            return response()->json($tipoTransporte, 200);

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