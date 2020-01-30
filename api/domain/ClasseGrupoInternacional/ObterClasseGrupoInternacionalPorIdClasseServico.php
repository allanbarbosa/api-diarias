<?php
declare(strict_types=1);

namespace Diarias\ClasseGrupoInternacional;

use Diarias\Classe\Models\ClasseModel;
use Diarias\Classe\Repositorios\ClasseRepositorio;


class ObterClasseGrupoInternacionalPorIdClasseServico
{
    protected $repositorio;

    public function __construct(ClasseRepositorio $classeRepositorio)
    {
        $this->repositorio = $classeRepositorio;
    }

    public function find(int $idClasse)
    {
        $classe = $this->repositorio->find($idClasse);

        return $this->tratarOutput($classe);
    }

    protected function tratarOutput(ClasseModel $classeModel)
    {
        $output = [
            'id' => $classeModel->clas_id,
            'nome' => $classeModel->clas_nome,
            'gratificacao' => [],
            'grupoPaises' => [],
        ];

        $gratificacoes = $classeModel->gratificacoes;

        foreach ($gratificacoes as $key => $gratificacao) {
            $output['gratificacao'][] = $gratificacao->grat_nome;
        }

        $classeGrupos = $classeModel->classeGrupoInternacional;

        foreach ($classeGrupos as $key => $grupo) {
            $output['grupoPaises'][$key] = [
                'id' => $grupo->clas_gru_internacional_id,
                'valor' => $grupo->clas_gru_internacional_valor,
                'descricao' => $grupo->grupo_internacional->grup_int_codigo,
                'paises' => [],
            ];

            $paises = $grupo->grupo_internacional->pais;

            foreach ($paises as $pais) {
                $output['grupoPaises'][$key]['paises'][] = $pais->pais_nome;
            }
        }

        return $output;

    }
}