<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Comprovante\ComprovanteServico;
use Diarias\Http\Requests\ComprovanteRequest;
use Exception;

class ComprovanteController extends Controller
{
    protected $servico;

    public function __construct(ComprovanteServico $comprovanteServico)
    {
        $this->servico = $comprovanteServico;
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
            
            $comprovante = $this->servico->find($id);

            return response()->json($comprovante, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ComprovanteRequest $request)
    {
        $input = $request->all();
        
        $comprovante = $this->servico->save($input);

        return response()->json($comprovante, 200);
    }

    public function update(ComprovanteRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $comprovante = $this->servico->update($input, $id);

            return response()->json($comprovante, 200);

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