<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\ViagemRequest;
use Diarias\Viagem\ViagemServico;
use Exception;

class ViagemController extends Controller
{
    protected $servico;

    public function __construct(ViagemServico $viagemServico)
    {
        $this->servico = $viagemServico;
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
            
            $viagem = $this->servico->find($id);

            return response()->json($viagem, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ViagemRequest $request)
    {
        $input = $request->all();
        
        $viagem = $this->servico->save($input);

        return response()->json($viagem, 200);
    }

    public function update(ViagemRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $viagem = $this->servico->update($input, $id);

            return response()->json($viagem, 200);

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