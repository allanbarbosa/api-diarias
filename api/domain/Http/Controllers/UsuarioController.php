<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\UsuarioRequest;
use Diarias\Usuario\UsuarioServico;
use Exception;

class UsuarioController extends Controller
{
    protected $servico;

    public function __construct(UsuarioServico $usuarioServico)
    {
        $this->servico = $usuarioServico;
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
            
            $usuario = $this->servico->find($id);

            return response()->json($usuario, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(UsuarioRequest $request)
    {
        $input = $request->all();
        
        $usuario = $this->servico->save($input);

        return response()->json($usuario, 200);
    }

    public function update(UsuarioRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $usuario = $this->servico->update($input, $id);

            return response()->json($usuario, 200);

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
