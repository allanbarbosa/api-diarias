<?php
declare(strict_types=1);

namespace Diarias\http\Controllers;

use Diarias\Classe\ClasseServico;
use Exception;
use App\Http\Controllers\Controller;
use Diarias\https\Requests\ClasseRequest;

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

        return response()-json($resposta, 200);
    }

    public function show($id)
    {
        try {

            $classe = $this->service->find((int)$id);

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

            $this->servico->delete($id);

            return response()->json('Resgistro excluído com sucesso', 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);
        }
        
    }
        
        
}

