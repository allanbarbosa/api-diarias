<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\FuncionarioRequest;
use Diarias\Funcionario\FuncionarioServico;
use Exception;

class FuncionarioController extends Controller
{
    protected $servico;

    public function __construct(FuncionarioServico $funcionarioServico)
    {
        $this->servico = $funcionarioServico;
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
            
            $funcionario = $this->servico->find($id);

            return response()->json($funcionario, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(FuncionarioRequest $request)
    {
        $input = $request->all();
        
        $funcionario = $this->servico->save($input);

        return response()->json($funcionario, 200);
    }

    public function update(FuncionarioRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $funcionario = $this->servico->update($input, $id);

            return response()->json($funcionario, 200);

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