<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\EmpresaRequest;
use Diarias\Empresa\EmpresaServico;
use Exception;

class EmpresaController extends Controller
{
    protected $servico;

    public function __construct(EmpresaServico $empresaServico)
    {
        $this->servico = $empresaServico;
    }

    public function index()
    {
        $input = request()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show($id)
    {
        try
        {
            $empresa = $this->servico->find($id);
            return response()->json($empresa, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['mensagem' => $e->getMenssage()], 400);
        }
    }

    public function store(EmpresaRequest $request)
    {
        $input = request()->all();

        $empresa = $this->servico->save($input);

        return response()->json($empresa, 200);
    }

    public function update(EmpresaRequest $request, int $id)
    {
        try
        {
            $input = $request->all();

            $empresa = $this->servico->update($input, $id);

            return response()->json($empresa, 200);

        }
        catch (Exception $e)
        {
            return response()->json(['mensagem' => $e->getMenssage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try
        {
            $this->servico->delete($id);

            return response()->json('Registro excluído com suceeso.', 200);
        }
        catch (Exception $e)
        {
            return response()->json(['mensagem' => $e->getMenssage()], 400);
        }
    }
}