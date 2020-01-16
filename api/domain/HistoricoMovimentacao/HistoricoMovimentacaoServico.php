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
            'hist_mov_data_tramitacao' => $input['data_tramitacao'],
            'hist_mov_observacao' => $input['mov_observacao'],
        ];
    }

    protected function tratarOutput(HistoricoMovimentacaoModel $historicoMovimentacaoModel)
    {
        return [
            'id' => $historicoMovimentacaoModel->hist_mov_id,
            'data_tramitacao' => $historicoMovimentacaoModel->hist_mov_data_tramitacao,
            'mov_observacao' => $historicoMovimentacaoModel->hist_mov_observacao,
        ];
    }
}