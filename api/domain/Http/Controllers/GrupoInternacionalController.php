<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\GrupoInternacional\GrupoInternacionalServico;
use Diarias\Http\Requests\GrupoInternacionalRequest;
use Exception;

class GrupoInternacionalController extends Controller
{
    protected $servico;

    public function __construct(GrupoInternacionalServico $grupointernacionalServico)
    {
        $this->servico = $grupointernacionalServico;
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
            
            $grupointernacional = $this->servico->find((int)$id);

            return response()->json($grupointernacional, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(GrupoInternacionalRequest $request)
    {
        $input = $request->all();
        
        $grupointernacional = $this->servico->save($input);

        return response()->json($grupointernacional, 200);
    }

    public function update(GrupoInternacionalRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $grupointernacional = $this->servico->update($input, $id);

            return response()->json($grupointernacional, 200);

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
