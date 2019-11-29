<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\ParametroRequest;
use Diarias\Parametro\ParametroServico;
use Exception;

class ParametroController extends Controller
{
    protected $servico;

    public function __construct(ParametroServico $parametroServico)
    {
        $this->servico = $parametroServico;
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
            
            $parametro = $this->servico->find($id);

            return response()->json($parametro, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ParametroRequest $request)
    {
        $input = $request->all();
        
        $parametro = $this->servico->save($input);

        return response()->json($parametro, 200);
    }

    public function update(ParametroRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $parametro = $this->servico->update($input, $id);

            return response()->json($parametro, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try {

            $this->servico->delete($id);

            return response()->json('Registro excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
}