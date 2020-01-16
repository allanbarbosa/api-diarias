<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Autenticacao\AutenticacaoServico;
use Diarias\Http\Requests\UnidadeRequest;
use Diarias\Unidade\UnidadeServico;
use Exception;


class UnidadeController extends Controller
{
    protected $servico;
    protected $autenticacaoServico;

    public function __construct(UnidadeServico $unidadeServico, AutenticacaoServico $autenticacaoServico)
    {
        $this->servico = $unidadeServico;
        $this->autenticacaoServico = $autenticacaoServico;
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
            
            $unidade = $this->servico->find($id);

            return response()->json($unidade, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(UnidadeRequest $request)
    {
        $token = request()->bearerToken();
        $dados = $this->autenticacaoServico->extrairDados($token);
        
        $input = $request->all();
        $input['created_by'] = $dados->data->id;
        
        $unidade = $this->servico->save($input);

        return response()->json($unidade, 200);
    }

    public function update(UnidadeRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $unidade = $this->servico->update($input, $id);

            return response()->json($unidade, 200);

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