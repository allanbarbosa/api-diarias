<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Estado\EstadoServico;
use Exception;
use Diarias\Htpp\Requests\EstadoRequest;

class estadoController extends Controller
{
    protected $servico;

    public function __construct(EstadoServico $estadoServico)
    {
        $this->servico = $estadoServico;
    }

    public function index()
    {
        $input = requet()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show($id)
    {
        try {

            $estado = $this->servico->find($id);

            return response()->json($estado, 200);

        } catch (Exception $e) {

            return response()->json(['mesagem' => $e->getMessege()], 400);

        }
    }

    public function store(EstadoRequest $request)
    {
        $input = $request->all();

        $estado = $this->servico->save($input);

        return response()->json($estado, 200);
    }

    public function update(EstadoRequest $request, int $id)
    {
        try {

            $input = $request->all();

            $estado = $this->servico->update($input, $id);

            return response()->json($estado, 200);

        } catch (Exception $e) {

            return response()->json(['mnsagem' => $e->getMessage()], 400);

        }
    }

    public function destroy(int $id)
    {
        try {

            $usuario = request()->get('usuario');

            $this->servico->delete($id, (int)$usuario);

            return response()->json('registro excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
}