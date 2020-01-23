<?php
declare(strict_types=1);

namespace Diarias\HistoricoStatus;

use Diarias\HistoricoStatus\Models\HistoricoStatusModel;
use Diarias\HistoricoStatus\Repositorios\HistoricoStatusRepositorio;

class HistoricoStatusServico
{
    protected $repositorio;

    public function __construct(HistoricoStatusRepositorio $historicoStatusRepositorio)
    {
        $this->repositorio = $historicoStatusRepositorio;
    }

    public function find(int $id)
    {
        $historicoStatus = $this->repositorio->find($id);

        return $this->tratarOutput($historicoStatus);
    }

    public function all(array $input)
    {
        $historicoStatuses = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($historicoStatuses as $historicoStatus) {
            $dados[] = $this->tratarOutput($historicoStatus);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $historicoStatus = $this->repositorio->save($dados);

        return $this->tratarOutput($historicoStatus);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $historicoStatus = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($historicoStatus);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'hist_sta_data_tramitacao' => $input['dataTramitacao'],
            'hist_sta_observacao' => isset($input['staObservacao']) ? $input['staObservacao'] : null,
            'id_viagem' => $input['idViagem'],
            'id_status' => $input['idStatus'],
            'id_lotacao' => $input['idLotacao']
        ];
    }

    protected function tratarOutput(HistoricoStatusModel $historicoStatusModel)
    {
        return [
            'id' => $historicoStatusModel->hist_sta_id,
            'dataTramitacao' => $historicoStatusModel->hist_sta_data_tramitacao,
            'staObservacao' => $historicoStatusModel->hist_sta_observacao,
            'idViagem' => $historicoStatusModel->id_viagem,
            'viagem' =>
            [
                'id' => $historicoStatusModel->viagem->viag_id,
                'objetivo' => $historicoStatusModel->viagem->viag_objetivo,
                'justFeriado' => $historicoStatusModel->viagem->viag_justificativa_feriado_fds,
                'justReprog' => $historicoStatusModel->viagem->viag_justificativa_reprogramacao,
                'flagAliCust' => $historicoStatusModel->viagem->viag_flag_alimentacao_custeada,
                'flagAdicDesl' => $historicoStatusModel->viagem->viag_flag_adicional_deslocamento,
                'flagUrgente' => $historicoStatusModel->status->viagem->viag_flag_urgente,
            ],
            'idStatus' => $historicoStatusModel->id_status,
            'status' =>
            [
                'id' => $historicoStatusModel->status->stat_id,
                'nome' => $historicoStatusModel->status->stat_nome,
                'slug' => $historicoStatusModel->status->stat_slug,
            ],
            'idLotacao' => $historicoStatusModel->id_lotacao,
            'lotacao' =>
            [
                'id' => $historicoStatusModel->lotacao->lota_id,
                'dataInicio' => $historicoStatusModel->lotacao->lota_data_inicio,
                'dataFim' => $historicoStatusModel->lotacao->lota_data_fim,
            ]
        ];
    }
}