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
            'hist_sta_data_tramitacao' => $input['data_tramitacao'],
            'hist_sta_observacao' => isset($input['sta_observacao']) ? $input['sta_observacao'] : null,
            'id_viagem' => $input['viagem'],
            'id_status' => $input['status'],
            'id_lotacao' => $input['lotacao']
        ];
    }

    protected function tratarOutput(HistoricoStatusModel $historicoStatusModel)
    {
        return [
            'id' => $historicoStatusModel->hist_sta_id,
            'data_tramitacao' => $historicoStatusModel->hist_sta_data_tramitacao,
            'sta_observacao' => $historicoStatusModel->hist_sta_observacao,
            'viagem' => $historicoStatusModel->id_viagem,
            'status' => $historicoStatusModel->id_status,
            'lotacao' => $historicoStatusModel->id_lotacao,
        ];
    }
}