<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\PerfilRequest;
use Diarias\Perfil\PerfilServico;
use Exception;

class PrerrogativaController extends Controller
{
    protected $servico;

    public function __construct(PerfilServico $perfilServico)
    {
        $this->servico = $perfilServico;
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
            
            $perfil = $this->servico->find($id);

            return response()->json($perfil, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(PerfilRequest $request)
    {
        $input = $request->all();
        
        $perfil = $this->servico->save($input);

        return response()->json($perfil, 200);
    }

    public function update(PerfilRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $perfil = $this->servico->update($input, $id);

            return response()->json($perfil, 200);

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
