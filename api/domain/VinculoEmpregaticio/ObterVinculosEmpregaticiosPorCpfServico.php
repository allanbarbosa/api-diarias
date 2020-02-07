<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Diarias\VinculoEmpregaticio\Repositorios\ObterVinculosEmpregaticiosPorCpfRepositorio;

class ObterVinculosEmpregaticiosPorCpfServico
{
    protected $repositorio;

    public function __construct(ObterVinculosEmpregaticiosPorCpfRepositorio $obterVinculosEmpregaticiosPorCpfRepositorio)
    {
        $this->repositorio = $obterVinculosEmpregaticiosPorCpfRepositorio;
    }

    public function find($cpf)
    {
        $vinculos = $this->repositorio->getWhere(['func_cpf' => $cpf]);

        if (count($vinculos) == 0) {
            throw new \Exception("Funcionário sem vínculo empregatício");
        }

        $output = [];

        foreach ($vinculos as $key => $vinculo) {
            $output[] = $this->tratarOutput($vinculo);
        }
        
        return $output;
    }
    
    protected function tratarOutput(VinculoEmpregaticioModel $model)
    {
        $lotacoes = $model->lotacao()->orderBy('created_at', 'DESC')->get();
            
        $output = [
            'id' => $model->vinc_emp_id,
            'dataAdmissao' => date('d/m/Y', strtotime($model->vinc_emp_data_admissao)),
            'dataDesligamento' => (!is_null($model->vinc_emp_data_desligamento)) ? date('d/m/Y', strtotime($model->vinc_emp_data_desligamento)) : null,
            'matricula' => $model->vinc_emp_matricula,
            'idFuncionario' => $model->id_funcionario,
            'funcionario' => [],
            'lotacao' => []
        ];
            
        $funcionario = $model->funcionario;
        
        $output['funcionario'] = [
            'id' => $funcionario->func_id,
            'cpf' => $funcionario->func_cpf,
            'email' => $funcionario->func_email,
            'idEmpresa' => $funcionario->id_empresa,
            'idEscolaridade' => $funcionario->id_escolaridade,
            'idProfissao' => $funcionario->id_profissao,
            'nome' => $funcionario->func_nome,
            'telefone' => $funcionario->func_telefone
        ];
        
        foreach ($lotacoes as $lotacao) {
            $output['lotacao'][] = [
                'id' => $lotacao->lota_id,
                'dataInicio' => date('d/m/Y', strtotime($lotacao->lota_data_inicio)),
                'dataFim' => (!is_null($lotacao->lota_data_fim)) ? date('d/m/Y', strtotime($lotacao->lota_data_fim)) : null
            ];
        }
                
        return $output;
    }
}

