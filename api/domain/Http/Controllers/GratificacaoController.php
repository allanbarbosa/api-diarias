<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\GratificacaoRequest;
use Diarias\Gratificacao\GratificacaoServico;
use Exception;

class GratificacaoController extends Controller
{
    protected $servico;

    public function __construct(GratificacaoServico $gratificacaoServico)
    {
        $this->servico = $gratificacaoServico;
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

            $gratificacao = $this->servico->find((int)$id);

            return response()->json($gratificacao, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(GratificacaoRequest $request)
    {
        $input = $request->all();

        $gratificacao = $this->servico->save($input);

        return response()->json($gratificacao, 200);
    }

    public function update(GratificacaoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();
        
            $gratificacao = $this->servico->update($input, $id);
        
            return response()->json($gratificacao, 200);

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
