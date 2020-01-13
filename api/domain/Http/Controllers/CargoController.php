<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\CargoRequest;
use Diarias\Cargo\CargoServico;
use Exception;

class CargoController extends Controller
{
    protected $servico;

    public function __construct(CargoServico $cargoServico)
    {
        $this->servico = $cargoServico;
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

            $cargo = $this->servico->find((int)$id);

            return response()->json($cargo, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(CargoRequest $request)
    {
        $input = $request->all();

        $cargo = $this->servico->save($input);

        return response()->json($cargo, 200);
    }

    public function update(CargoRequest $request, int $id)
    {
        try {
            
            $input = $request->all();
        
            $cargo = $this->servico->update($input, $id);
        
            return response()->json($cargo, 200);

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
