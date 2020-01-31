<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Diarias\VinculoEmpregaticio\Repositorios\ObterLotacaoPorMatriculaRepositorio;

class ObterLotacaoPorMatriculaServico
{
    protected $repositorio;

    public function __construct(ObterLotacaoPorMatriculaRepositorio $obterLotacaoPorMatriculaRepositorio)
    {
        $this->repositorio = $obterLotacaoPorMatriculaRepositorio;
    }

    public function find($matricula)
    {
        $obterLotacaoPorMatricula = $this->repositorio->find($matricula);

        return $this->tratarOutput($obterLotacaoPorMatricula);
    }

    // protected function tratarInput(array $input)
    // {
    //     return [
    //         'vinc_emp_matricula' => $input['matricula']
    //     ];
    // }

    protected function tratarOutput(VinculoEmpregaticioModel $model)
    {
    
        $lotacao = $model->lotacao()
            ->whereNull('lota_data_fim')
            ->orderBy('lota_id', 'DESC')
            ->first();

        if (!$lotacao) {
            throw new \Exception("Funcionário sem lotação");
        }

        $output = [
            'id' => $lotacao->lota_id,
            'dataInicio' => date('d/m/Y', strtotime($lotacao->lota_data_inicio)),
            'dataFim' => null,
            'idCargo' => $lotacao->id_cargo,
            'idUnidadeOrganograma' => $lotacao->id_unidade_organograma,
            'idVinculoEmpregaticio' => $lotacao->id_vinculo_empregaticio,
            'cargo' => [],
            'vinculoEmpregaticio' => [
                'id' => $model->vinc_emp_id,
                'dataAdmissao' => date('d/m/Y', strtotime($model->vinc_emp_data_admissao)),
                'dataDesligamento' => (!is_null($model->vinc_emp_data_desligamento)) ? date('d/m/Y', strtotime($model->vinc_emp_data_desligamento)) : null,
                'matricula' => $model->vinc_emp_matricula,
                'idFuncionario' => $model->id_funcionario,
                'funcionario' => []
            ],
        ];

        $funcionario = $model->funcionario;

        $output['vinculoEmpregaticio']['funcionario'] = [
            'id' => $funcionario->func_id,
            'cpf' => $funcionario->func_cpf,
            'email' => $funcionario->func_email,
            'idEmpresa' => $funcionario->id_empresa,
            'idEscolaridade' => $funcionario->id_escolaridade,
            'idProfissao' => $funcionario->id_profissao,
            'nome' => $funcionario->func_nome,
            'telefone' => $funcionario->func_telefone
        ];
        
        $cargo = $lotacao->cargo;

        if ($cargo) {
            $output['cargo'] = [
                'id' => $cargo->carg_id,
                'nome' => $cargo->carg_nome,
                'slug' => $cargo->carg_slug,
                'gratificacao' => [],
            ];

            $gratificacao = $cargo->gratificacao;

            $output['cargo']['gratificacao'] = [
                'id' => $gratificacao->grat_id,
                'nome' => $gratificacao->grat_nome,
                'slug' => $gratificacao->grat_slug,
                'idClasse' => $gratificacao->id_classe,
                'valorDiaria' => $gratificacao->grat_valor_diaria,
            ];
        }
        return $output;
    }
}
