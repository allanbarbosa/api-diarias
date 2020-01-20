<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\FuncionarioPrerrogativa\FuncionarioPrerrogativaServico;
use Diarias\Http\Requests\FuncionarioPrerrogativaRequest;
use Exception;

class FuncionarioPrerrogativaController extends Controller
{
    protected $servico;

    public function __construct(FuncionarioPrerrogativaServico $funcionarioPrerrogativaServico)
    {
        $this->servico = $funcionarioPrerrogativaServico;
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
            
            $funcionarioPrerrogativa = $this->servico->find($id);

            return response()->json($funcionarioPrerrogativa, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(FuncionarioPrerrogativaRequest $request)
    {
        $input = $request->all();
        
        $funcionarioPrerrogativa = $this->servico->save($input);

        return response()->json($funcionarioPrerrogativa, 200);
    }

    public function update(FuncionarioPrerrogativaRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $funcionarioPrerrogativa = $this->servico->update($input, $id);

            return response()->json($funcionarioPrerrogativa, 200);

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
