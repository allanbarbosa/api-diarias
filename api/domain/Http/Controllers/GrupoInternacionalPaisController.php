<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\GrupoInternacionalPais\GrupoInternacionalPaisServico;
use Diarias\Http\Requests\GrupoInternacionalPaisRequest;
use Exception;

class GrupoInternacionalPaisController extends Controller
{
    protected $servico;

    public function __construct(GrupoInternacionalPaisServico $grupointernacionalPaisServico)
    {
        $this->servico = $grupointernacionalPaisServico;
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
            
            $grupointernacionalPais = $this->servico->find((int)$id);

            return response()->json($grupointernacionalPais, 200);

        } catch (Exception $e) {
            
            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }

    public function store(GrupoInternacionalPaisRequest $request)
    {
        $input = $request->all();
        
        $grupointernacionalPais = $this->servico->save($input);

        return response()->json($grupointernacionalPais, 200);
    }

    public function update(GrupoInternacionalPaisRequest $request, int $id)
    {
        try {
            
            $input = $request->all();

            $grupointernacionalPais = $this->servico->update($input, $id);

            return response()->json($grupointernacionalPais, 200);

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
