<?php
declare(strict_types=1);

namespace Diarias\Lotacao;

use Diarias\Lotacao\Models\LotacaoModel;
use Diarias\Lotacao\Repositorios\LotacaoRepositorio;

class LotacaoServico
{
    protected $repositorio;

    public function __construct(LotacaoRepositorio $lotacaoRepositorio)
    {
        $this->repositorio = $lotacaoRepositorio;
    }

    public function find(int $id)
    {
        $lotacao = $this->repositorio->find($id);

        return $this->tratarOutput($lotacao);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $model = $this->tratarInput($input);

        $lotacaoAtual = $this->repositorio->getLotacaoAtualDoVinculo($model['id_vinculo_empregaticio']);
        if ($lotacaoAtual != null) {
            // desliga lotação anterior:
            $dataDesligamentoLotacao = date('Y-m-d', strtotime('-1 day', strtotime($model['lota_data_inicio'])));
            $this->repositorio->desligarLotacao($lotacaoAtual->lota_id, $dataDesligamentoLotacao);
        }
        $lotacao = $this->repositorio->save($model);


        return $this->tratarOutput($lotacao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $lotacao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($lotacao);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
           
            'lota_data_inicio' => $input['dataInicio'],
            'lota_data_fim' => isset($input['dataFim']) ? $input['dataFim'] : null,
            'id_cargo' => $input['idCargo'],
            'id_unidade_organograma' => $input['idUnidadeOrganograma'],
            'id_vinculo_empregaticio' => $input['idVinculoEmpregaticio']
        ];
    }

  protected function tratarOutput(LotacaoModel $model)
  {
    return [
        'id' => $model->lota_id,
        'dataInicio' => $model->lota_data_inicio,
        'dataFim' => $model->lota_data_fim,
        'idCargo' => $model->id_cargo,
        'cargo' =>
        [
            'id' => $model->cargo->carg_id,
            'nome' => $model->cargo->carg_nome,
            'slug' => $model->cargo->carg_slug,
            'idGratificacao' => $model->cargo->id_gratificacao
        ],
        'idUnidadeOrganograma' => $model->id_unidade_organograma,
        'unidadeOrganograma' =>
        [
            'id' => $model->unidade_organograma->unid_org_id,
            'idUnidade' => $model->unidade_organograma->id_unidade,
            'idUnidadePai' => $model->unidade_organograma->id_unidade_pai,
            'idOrganograma' => $model->unidade_organograma->id_organograma,
            'idPapelFluxograma' => $model->unidade_organograma->id_papel_fluxograma
        ],
        'idVinculoEmpregaticio' => $model->id_vinculo_empregaticio,
        'vinculoEmpregaticio' =>
        [
            'id' => $model->vinculo_empregaticio->vinc_emp_id,
            'matricula' => $model->vinculo_empregaticio->vinc_emp_matricula,
            'dataAdmissao' => $model->vinculo_empregaticio->vinc_emp_data_admissao,
            'dataDesligamento' => $model->vinculo_empregaticio->vinc_emp_data_desligamento
        ]
        // 'historicoStatus' => $model->historico_status,
        // 'historicoMovimentacoes' => $model->historico_movimentacoes,
        // 'viagens' => $model->viagens
    ];
  }
}