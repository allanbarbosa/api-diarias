<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;


use App\Http\Controllers\Controller;
use Diarias\ClasseGrupoInternacional\ObterClasseGrupoInternacionalPorIdClasseServico;
use Exception;

class ObterClasseGrupoInternacionalPorIdClasseController extends Controller
{
    protected $servico;

    public function __construct(ObterClasseGrupoInternacionalPorIdClasseServico $obterClasseGrupoInternacionalPorIdClasseServico)
    {
        $this->servico = $obterClasseGrupoInternacionalPorIdClasseServico;

    }

    public function show(int $idClasse)
    {
        try {

            $obterClasseGrupoInternacionalPorIdClasse = $this->servico->find($idClasse);

            return response()->json($obterClasseGrupoInternacionalPorIdClasse, 200);

        } catch (Exception $e) {

            return response()->json(['mensagem' => $e->getMessage()], 400);

        }
    }
}