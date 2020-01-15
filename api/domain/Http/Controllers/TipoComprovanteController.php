<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\TipoComprovanteRequest;
use Diarias\TipoComprovante\TipoComprovanteServico;
use Exception;

class TipoComprovanteController extends Controller
{
    protected $servico;

    public function __construct(TipoComprovanteServico $tipoComprovanteServico)
    {
        $this->servico = $tipoComprovanteServico;
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
            
            $tipoComprovante = $this->servico->find($id);

            return response()->json($tipoComprovante, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(TipoComprovanteRequest $request)
    {
        $input = $request->all();
        
        $tipoComprovante = $this->servico->save($input);

        return response()->json($tipoComprovante, 200);
    }

    public function update(TipoComprovanteRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $tipoComprovante = $this->servico->update($input, $id);

            return response()->json($tipoComprovante, 200);

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
