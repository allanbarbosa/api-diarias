<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\ProfissaoResquest;
use Diarias\Profissao\ProfissaoServico;
use Exception;


class ProfissaoController extends Controller
{
    protected $servico;

    public function __construct(ProfissaoServico $profissaoServico)
    {
        $this->servico = $profissaoServico;
    }

    public function index()
    {
        $input = request()->all();

        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show(int $id)
    {
        try
        {
            $profissao = $this->servico->find($id);
            return response()->json($profissao, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['mensagem' => $e->getMenssage()], 400);
        }       
    }

    public function store(ProfissaoResquest $request)
    {
        $input = $request->all();

        $profissao = $this->servico->save($input);

        return response()->json($profissao, 200);
    }

    public function update(ProfissaoResquest $request, int $id)
    {
        try
        {
            $input = request()->all();
    
            $profissao = $this->servico->update($input, $id);

            return response()->json($profissao, 200);
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
            $usuario = request()->get('usuario');

            $this->servico->delete($id, (int)$usuario);

            return response()->json('Registro excluído com sucesso.', 200);
        }
        catch (Exception $e)
        {
            return response()->json(['mansagem' => $e->getMenssage()], 400);
        }
    }
}