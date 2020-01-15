<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\ParticularidadeRequest;
use Diarias\Particularidade\ParticularidadeServico;
use Exception;

class ParticularidadeController extends Controller
{
    protected $servico;

    public function __construct(ParticularidadeServico $particularidadeServico)
    {
        $this->servico = $particularidadeServico;
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
            
            $particularidade = $this->servico->find($id);

            return response()->json($particularidade, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ParticularidadeRequest $request)
    {
        $input = $request->all();
        
        $particularidade = $this->servico->save($input);

        return response()->json($particularidade, 200);
    }

    public function update(ParticularidadeRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $particularidade = $this->servico->update($input, $id);

            return response()->json($particularidade, 200);

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
