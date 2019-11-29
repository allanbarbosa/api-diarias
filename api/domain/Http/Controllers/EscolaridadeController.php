<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\EscolaridadeRequest;
use Diarias\Escolaridade\EscolaridadeServico;
use Exception;

class EscolaridadeController extends Controller
{
    protected $servico;

    public function __construct(EscolaridadeServico $escolaridadeServico)
    {
        $this->servico = $$escolaridadeServico;
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
            
            $escolaridade = $this->servico->find($id);

            return response()->json($escolaridade, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(EscolaridadeRequest $request)
    {
        $input = $request->all();
        
        $escolaridade = $this->servico->save($input);

        return response()->json($escolaridade, 200);
    }

    public function update(EscolaridadeRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $escolaridade = $this->servico->update($input, $id);

            return response()->json($escolaridade, 200);

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