<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\PrerrogativaRequest;
use Diarias\Prerrogativa\PrerrogativaServico;
use Exception;

class PrerrogativaController extends Controller
{
    protected $servico;

    public function __construct(PrerrogativaServico $prerrogativaServico)
    {
        $this->servico = $prerrogativaServico;
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
            
            $prerrogativa = $this->servico->find($id);

            return response()->json($prerrogativa, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(PrerrogativaRequest $request)
    {
        $input = $request->all();
        
        $prerrogativa = $this->servico->save($input);

        return response()->json($prerrogativa, 200);
    }

    public function update(PrerrogativaRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $prerrogativa = $this->servico->update($input, $id);

            return response()->json($prerrogativa, 200);

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
