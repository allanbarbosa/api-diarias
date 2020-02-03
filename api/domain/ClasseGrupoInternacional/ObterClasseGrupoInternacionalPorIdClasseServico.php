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
       
        $classeGrupos = $classeModel->classeGrupoInternacional;

        $output = [];

        $gratificacoes = $classeModel->gratificacoes;
        $dadosGratificacao = [];
        
        foreach ($gratificacoes as $key => $gratificacao) {
            $dadosGratificacao[] = [
                'id' => $gratificacao->grat_id,
                'nome' => $gratificacao->grat_nome,
                'slug' => $gratificacao->grat_slug,
                'valorDiaria' => $gratificacao->grat_valor_diaria,
                'idClasse' => $classeModel->clas_id
            ];
        }
        
        foreach ($classeGrupos as $key => $grupo) {
            
            $output[$key] = [
                'id' => $grupo->clas_gru_internacional_id,
                'valor' => $grupo->clas_gru_internacional_valor,
                'idClasse' => $classeModel->clas_id,
                'classe' => [
                    'id' => $classeModel->clas_id,
                    'nome' => $classeModel->clas_nome,
                    'gratificacoes' => $dadosGratificacao,
                ],
                'idGrupoInternacional' => $grupo->clas_gru_internacional_id,
                'grupoInternacional' => [],
                'paises' => []
            ];
                        
            $output[$key]['grupoInternacional'][] = [
                'id' => $grupo->grupo_internacional->grup_int_id,
                'codigo' => $grupo->grupo_internacional->grup_int_codigo,
            ];
            
            $paises = $grupo->grupo_internacional->pais;
            
            foreach ($paises as $pais) {
                $output[$key]['paises'][] = $pais->pais_nome;
            }
        }
        
        
        return $output;

    }
}