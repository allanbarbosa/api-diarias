<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio;

use Diarias\Lotacao\Repositorios\LotacaoRepositorio;
use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Diarias\VinculoEmpregaticio\Repositorios\VinculoEmpregaticioRepositorio;

class VinculoEmpregaticioServico
{
    protected $repositorio;
    protected $repositorioLotacao;

    public function __construct(
        VinculoEmpregaticioRepositorio $vinculoEmpregaticioRepositorio, 
        LotacaoRepositorio $lotacaoRepositorio
    )
    {
        $this->repositorio = $vinculoEmpregaticioRepositorio;
        $this->repositorioLotacao = $lotacaoRepositorio;
    }

    public function find(int $id)
    {
        $vinculoEmpregaticio = $this->repositorio->find($id);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $vinculoEmpregaticio = $this->repositorio->save($dados);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $vinculoEmpregaticio = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
           
            'vinc_emp_matricula' => $input['matricula'],
            'vinc_emp_data_admissao' => isset($input['dataAdmissao']) ? $input['dataAdmissao'] : null,
            'vinc_emp_data_desligamento' => isset($input['dataDesligamento']) ? $input['dataDesligamento'] : null,
            'id_funcionario' => $input['idFuncionario']
        ];
    }

    protected function tratarOutput(VinculoEmpregaticioModel $model)
    {
        $output = [
            'id' => $model->vinc_emp_id,
            'matricula' => $model->vinc_emp_matricula,
            'dataAdmissao' => $model->vinc_emp_data_admissao,
            'dataDesligamento' => $model->vinc_emp_data_desligamento,
            'idFuncionario' => $model->id_funcionario,
            'funcionario' =>
            [
                'id' => $model->funcionario->func_id,
                'cpf' => $model->funcionario->func_cpf,
                'nome' => $model->funcionario->func_nome,
                'telefone' => $model->funcionario->func_telefone,
                'email' => $model->funcionario->func_email,
                'idEmpresa' => $model->funcionario->id_empresa,
                'idProfissao' => $model->funcionario->id_profissao,
                'idEscolaridade' => $model->funcionario->id_escolaridade
            ],
            'lotacoes' => []
        ];
        if ($model->lotacoes) {
            foreach ($model->lotacoes as $lotacao) {
                $output['lotacoes'][] = [
                    'id' => $lotacao->lota_id,
                    'dataInicio' => $lotacao->lota_data_inicio,
                    'dataFim' => $lotacao->lota_data_fim,
                    'idCargo' => $lotacao->id_cargo,
                    'idUnidadeOrganograma' => $lotacao->id_unidade_organograma,
                    'idVinculoEmpregaticio' => $lotacao->id_vinculo_empregaticio
                ];
            }
        }
        return $output;
    }

    public function desligarVinculoEmpregaticio(int $idVinculoEmpregaticio, $dataDesligamento)
    {
        $lotacaoAtual = $this->repositorioLotacao->getLotacaoAtualDoVinculo($idVinculoEmpregaticio);
        if ($lotacaoAtual != null) {
            $lotacaoAtual->lota_data_fim = $dataDesligamento;
            $this->repositorioLotacao->update($lotacaoAtual->toArray(), $lotacaoAtual->lota_id);
        }
        $vinculoEmpregaticio = $this->repositorio->find($idVinculoEmpregaticio);
        $vinculoEmpregaticio->vinc_emp_data_desligamento = $dataDesligamento;
        $this->repositorio->update($vinculoEmpregaticio->toArray(), $vinculoEmpregaticio->vinc_emp_id);
    }
}