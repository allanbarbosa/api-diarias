<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\LotacaoRequest;
use Diarias\Lotacao\LotacaoServico;
use Exception;

class LotacaoController extends Controller
{
    protected $servico;

    public function __construct(LotacaoServico $lotacaoServico)
    {
        $this->servico = $lotacaoServico;
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

            $lotacao = $this->servico->find((int)$id);

            return response()->json($lotacao, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(LotacaoRequest $request)
    {
        $input = $request->all();

        $lotacao = $this->servico->save($input);

        return response()->json($lotacao, 200);
    }

    public function update(LotacaoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();
        
            $lotacao = $this->servico->update($input, $id);
        
            return response()->json($lotacao, 200);

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
