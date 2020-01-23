<?php
declare(strict_types=1);

namespace Diarias\HistoricoMovimentacao;

use Diarias\HistoricoMovimentacao\Models\HistoricoMovimentacaoModel;
use Diarias\HistoricoMovimentacao\Repositorios\HistoricoMovimentacaoRepositorio;

class HistoricoMovimentacaoServico
{
    protected $repositorio;

    public function __construct(HistoricoMovimentacaoRepositorio $historicoMovimentacaoRepositorio)
    {
        $this->repositorio = $historicoMovimentacaoRepositorio;
    }

    public function find(int $id)
    {
        $historicoMovimentacao = $this->repositorio->find($id);

        return $this->tratarOutput($historicoMovimentacao);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $historicoMovimentacao = $this->repositorio->save($dados);

        return $this->tratarOutput($historicoMovimentacao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $historicoMovimentacao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($historicoMovimentacao);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'hist_mov_data_tramitacao' => $input['dataTramitacao'],
            'hist_mov_observacao' => isset($input['movObservacao']) ? $input['movObservacao'] : null,
            'id_movimentacao' => $input['idMovimentacao'],
            'id_viagem' => $input['idViagem'],
            'id_lotacao' => $input['idLotacao']
        ];
    }

    protected function tratarOutput(HistoricoMovimentacaoModel $historicoMovimentacaoModel)
    {
        return [
            'id' => $historicoMovimentacaoModel->hist_mov_id,
            'dataTramitacao' => $historicoMovimentacaoModel->hist_mov_data_tramitacao,
            'movObservacao' => $historicoMovimentacaoModel->hist_mov_observacao,
            'idMovimentacao' => $historicoMovimentacaoModel->id_movimentacao,
            'movimentacao' =>
            [
                'id' => $historicoMovimentacaoModel->movimentacao->movi_id,
                'nome' => $historicoMovimentacaoModel->movimentacao->movi_nome,
                'slug' => $historicoMovimentacaoModel->movimentacao->movi_slug,
            ],
            'idViagem' => $historicoMovimentacaoModel->id_viagem,
            'viagem' =>
            [
                'id' => $historicoMovimentacaoModel->viagem->viag_id,
                'objetivo' => $historicoMovimentacaoModel->viagem->viag_objetivo,
                'justFeriado' => $historicoMovimentacaoModel->viagem->viag_justificativa_feriado_fds,
                'justReprog' => $historicoMovimentacaoModel->viagem->viag_justificativa_reprogramacao,
                'flagAliCust' => $historicoMovimentacaoModel->viagem->viag_flag_alimentacao_custeada,
                'flagAdicDesl' => $historicoMovimentacaoModel->viagem->viag_flag_adicional_deslocamento,
                'flagUrgente' => $historicoMovimentacaoModel->viagem->viag_flag_urgente,
            ],
            'idLotacao' => $historicoMovimentacaoModel->id_lotacao,
            'lotacao' =>
            [
                'id' => $historicoMovimentacaoModel->lotacao->lota_id,
                'dataInicio' => $historicoMovimentacaoModel->lotacao->lota_data_inicio,
                'dataFim' => $historicoMovimentacaoModel->lotacao->lota_data_fim,
            ]
        ];
    }
}