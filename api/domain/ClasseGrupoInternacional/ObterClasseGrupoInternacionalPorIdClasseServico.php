<?php
declare(strict_types=1);

namespace Diarias\ClasseGrupoInternacional;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Diarias\ClasseGrupoInternacional\Repositorios\ObterClasseGrupoInternacionalPorIdClasseRepositorio;


class ObterClasseGrupoInternacionalPorIdClasseServico
{
    protected $repositorio;

    public function __construct(ObterClasseGrupoInternacionalPorIdClasseRepositorio $obterClasseGrupoInternacionalPorIdClasseRepositorio)
    {
        $this->repositorio = $obterClasseGrupoInternacionalPorIdClasseRepositorio;
    }

    public function find(int $idClasse)
    {
        $obterClasseGrupoInternacionalPorIdClasse = $this->repositorio->find($idClasse);

        return $this->tratarOutput($obterClasseGrupoInternacionalPorIdClasse);
    }


    protected function tratarInput(array $input)
    {
        return [
            
           'id_classe' => $input['idClasse'],
           
        ];
    }

    protected function tratarOutput(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        $output = [
            
            'classe' =>
            [
                'id' => $classeGrupoInternacionalModel->classe->clas_id,
                'nome' => $classeGrupoInternacionalModel->classe->clas_nome,
                'gratificacoes' => []
            ],
            'classeGrupoInternacional' => 
            [
                'id' => $classeGrupoInternacionalModel->clas_gru_internacional_id,
                'valor' => $classeGrupoInternacionalModel->clas_gru_internacional_valor,
            ],
            'idGrupoInternacional' => $classeGrupoInternacionalModel->id_grupo_internacional,
            'grupoInternacional' =>
            [
                'id' => $classeGrupoInternacionalModel->grupo_internacional->grup_int_id,
                'codigo' => $classeGrupoInternacionalModel->grupo_internacional->grup_int_codigo
            ]
        ];
        
        $gratificacoes = $classeGrupoInternacionalModel->classe->gratificacoes;

        foreach ($gratificacoes as $gratificacao) {
            $output['classe']['gratificacoes'][] = [
                'id' => $gratificacao->grat_id,
                'nome' => $gratificacao->grat_nome,
                'slug' => $gratificacao->grat_slug,
                'valor' => $gratificacao->grat_valor_diaria
            ];
        }
        return $output;
    }
}
