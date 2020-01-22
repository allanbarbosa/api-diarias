<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\Http\Requests\MunicipioRequest;
use Diarias\Municipio\MunicipioServico;
use Exception;

class MunicipioController extends Controller
{
    protected $servico;

    public function __construct(MunicipioServico $municipioServico)
    {
        $this->servico = $municipioServico;
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

            $municipio = $this->servico->find((int)$id);

            return response()->json($municipio, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(MunicipioRequest $request)
    {
        $input = $request->all();

        $municipio = $this->servico->save($input);

        return response()->json($municipio, 200);
    }

    public function update(MunicipioRequest $request, int $id)
    {
        try {
            
            $input = $request->all();
        
            $municipio = $this->servico->update($input, $id);
        
            return response()->json($municipio, 200);

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
