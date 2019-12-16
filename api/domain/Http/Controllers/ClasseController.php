<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Classe\ClasseServico;
use Diarias\Http\Requests\ClasseRequest;
use Exception;

class ClasseController extends Controller
{
    protected $servico;

    public function __construct(classeServico $classeServico)
    {
        $this->servico = $classeServico;
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

            $classe = $this->servico->find($id);

            return response()-> json($classe, 200);

        }catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ClasseRequest $request)
    {
        $input = $request->all();

        $classe = $this->servico->save($input);

        return response()->json($classe, 200);
    }
    
    public function update(classeRequest $request, int $id)
    {
        try {

            $input = $request->all();

            $classe = $this->servico->update($input, $id);

            return response()->json($classe, 200);

        } catch (Exception $e) {
         
            return response()->json(['mensagem' => $e->getMessage()], 400);
        }

    }  

    public function destroy(int $id)
    {
        try {

            $usuario = request()->get('usuario');

            $this->servico->delete($id, (int)$usuario);

            return response()->json('Resgistro excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
        
    }
        
        
}

