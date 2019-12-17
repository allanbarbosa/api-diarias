<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Pais\PaisServico;
use Diarias\Http\Requests\PaisRequest;
use Exception;

class paisController extends Controller
{
    protected $servico;

    public function __construct(PaisServico $paisServico)
    {
        $this->servico = $paisServico;
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

            $pais = $this->servico->find($id);

            return response()->json($pais, 200);

        } catch (Exception $e) {

            return response()->json(['mesagem' => $e->getMessage()], 400);

        }
    }

    public function store(PaisRequest $request)
    {
        $input = $request->all();

        $pais = $this->servico->save($input);

        return response()->json($pais, 200);
    }

    public function update(PaisRequest $request, int $id)
    {
        try {

            $input = $request->all();

            $pais = $this->servico->update($input, $id);

            return response()->json($pais, 200);

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