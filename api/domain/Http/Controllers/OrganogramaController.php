<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Requests\OrganogramaRequest;
use Diarias\Organograma\OrganogramaServico;
use Exception;


class OrganogramaController extends Controller
{
    protected $servico;

    public function __construct(OrganogramaServico $servico)
    {
        $this->servico = $servico;
    }

    public function index()
    {
        $input = request()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show(int $id)
    {
        try{

            $organograma = $this->servico->find((int)$id);

            return response()->json($organograma, 200);

        }catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

    public function store(OrganogramaRequest $request)
    {
       $input = $request->all();

       $organograma = $this->servico-save($input);

       return response()->json($organograma, 200);
    }

    public function updade(OrganogramaRequest $request, int $id)
    {
        try {

            $input = $request->all();

            $organograma = $this->servico->update($input, $id);

            return response()->json($organograma, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessagem()], 400);
        }
    }           
    public function destroy(int $id)
    {
        try {

            $usuario = request()->get('usuario');

            $this->service->delete($id, (int)$usuario);

            return response()->json('Registro excluido com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }

    }

    public function obterOrganogramaAtual()
    {
        try {
            $organogramaAtual = $this->servico->obterOrganogramaAtual();
            return response()->json($organogramaAtual, 200);
        } catch (Exception $e) {
            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }
    
    public function obterSugestaoCodigo()
    {
        try {
            $codigoSugerido = $this->servico->obterSugestaoCodigo();
            return response($codigoSugerido, 200);
        } catch (Exception $ex) {
            return response()->json(['mensagem' => $ex->getMessage()], 400);
        }
    }
}