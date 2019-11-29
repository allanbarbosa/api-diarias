<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\FeriadoRequest;
use Diarias\Feriado\FeriadoServico;
use Exception;

class FeriadoController extends Controller
{
    protected $servico;

    public function __construct(FeriadoServico $feriadoServico)
    {
        $this->servico = $feriadoServico;
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
            
            $feriado = $this->servico->find($id);

            return response()->json($feriado, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(FeriadoRequest $request)
    {
        $input = $request->all();
        
        $prerrogativa = $this->servico->save($input);

        return response()->json($prerrogativa, 200);
    }

    public function update(FeriadoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $feriado = $this->servico->update($input, $id);

            return response()->json($feriado, 200);

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