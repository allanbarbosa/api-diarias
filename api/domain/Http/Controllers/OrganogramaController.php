<?php

declare(strict_types=1);

namespace Diarias\Https\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Http\Request\OrganogramaRequest;
use Diarias\Organograma\OrganogramaServico;
use Exception;


class OrganogramaController extends controller
{
    protected $servico;

    public function __construct(OrganogramaServico $organogramaServico)
    {
        $this->servico = $organogramaServico;
    }

    public function index()
    {
        $input = request()->all();
        $resposta = $this->servico->all($input);

        return response()->json($resposta, 200);
    }

    public function show($id)
    {
        try{

            $organograma = $this->servico->find($id);

            return response()->json($organograma, 200);

        }catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
    }

    public function store(OraganogramaRequest $request)
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

        } catch (Execption $e) {

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

            return response()->json(['mesnsagem' => $e->getMessage()], 400);

        }

    }
    
}            

    