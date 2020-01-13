<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Ferias\FeriasServico;
use Diarias\Http\Requests\FeriasRequest;
use Exception;

class FeriasController extends Controller
{
    protected $servico;

    public function __construct(FeriasServico $feriasServico)
    {
        $this->servico = $feriasServico;
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
            
            $ferias = $this->servico->find($id);

            return response()->json($ferias, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(FeriasRequest $request)
    {
        $input = $request->all();
        
        $ferias = $this->servico->save($input);

        return response()->json($ferias, 200);
    }

    public function update(FeriasRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $ferias = $this->servico->update($input, $id);

            return response()->json($ferias, 200);

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