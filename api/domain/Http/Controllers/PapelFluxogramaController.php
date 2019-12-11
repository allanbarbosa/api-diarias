<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\PapelFluxograma\PapelFluxogramaServico;
use Exception;
use Diarias\Https\Requests\PapelFluxogramaRequest;

class PapelFluxogramaController extends Controller
{
    protected $servico;

    public function __construct(PapelFluxogramaServico $papelfluxogramaServico)
    {
        $this->servico = $papelfluxogramaServico;
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
            $papelfluxograma = $this->servico->find($id);

            return response()->json($papelfluxograma, 200);

        } catch (Exception $e) {
            
            return reposnse()->json(['mesagem' => $e->getMessage()], 400);
        
        }
    }


    public function store(PapelFluxogramaRequest $request)
    {
        $input = $request->all();

        $papelfluxograma = $this->servico->save($input);

        return response()->json(papelfluxograma, 200);
    }

    public function update(PapelfluxogramaRequest $request, int $id)
    {
        try {

            $input = $request->all();
            
            $papelfluxograma = $this->servico->update($input, $id);
            
            return response()->json($papelfluxograma, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try{

            $usuario = request()->get('usuario');

            $this->servico->delete($id, (int)$usuario);

            return response()->json('Registro Excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

}
