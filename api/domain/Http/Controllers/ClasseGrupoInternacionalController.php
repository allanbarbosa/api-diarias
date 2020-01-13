<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\ClasseGrupoInternacional\ClasseGrupoInternacionalServico;
use Diarias\Http\Requests\ClasseGrupoInternacionalRequest;
use Exception;

class ClasseGrupoInternacionalController extends Controller
{
    protected $servico;

    public function __construct(ClasseGrupoInternacionalServico $classeGrupoInternacionalServico)
    {
        $this->servico = $classeGrupoInternacionalServico;
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
            
            $classeGrupoInternacional = $this->servico->find($id);

            return response()->json($classeGrupoInternacional, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(ClasseGrupoInternacionalRequest $request)
    {
        $input = $request->all();
        
        $classeGrupoInternacional = $this->servico->save($input);

        return response()->json($classeGrupoInternacional, 200);
    }

    public function update(ClasseGrupoInternacionalRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $classeGrupoInternacional = $this->servico->update($input, $id);

            return response()->json($classeGrupoInternacional, 200);

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
