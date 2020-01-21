<?php
declare(strict_types=1);

namespace Diarias\Comprovacao;

use Diarias\Comprovacao\Models\ComprovacaoModel;
use Diarias\Comprovacao\Repositorios\ComprovacaoRepositorio;

class ComprovacaoServico
{
    protected $repositorio;

    public function __construct(ComprovacaoRepositorio $comprovacaoRepositorio)
    {
        $this->repositorio = $comprovacaoRepositorio;
    }

    public function find(int $id)
    {
        $comprovacao = $this->repositorio->find($id);

        return $this->tratarOutput($comprovacao);
    }

    public function all(array $input)
    {
        $comprovacoes = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($comprovacoes as $comprovacao)
        {
            $dados[] = $this->tratarOutput($comprovacao);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $comprovacao = $this->repositorio->save($dados);

        return $this->tratarOutput($comprovacao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $comprovacao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($comprovacao);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'comp_diarias_utilizadas' => $input['diarias_utilizadas'],
            'comp_data_hora_saida_efetiva' => $input['data_hora_saida_efetiva'],
            'comp_data_hora_chegada_efetiva' => $input['data_hora_chegada_efetiva'],
            'comp_atividades_desenvolvidas' => $input['atividades_desenvolvidas'],
            'comp_saldo_receber' => isset($input['saldo_receber']) ? $input['saldo_receber'] : null,
            'comp_saldo_restituir' => isset($input['saldo_restituir']) ? $input['saldo_restituir'] : null,
            'comp_valor_total' => isset($input['valor_total']) ? $input['valor_total'] : null,
            'id_trecho' => $input['trecho'],
        ];
    }

    protected function tratarOutput(ComprovacaoModel $comprovacaoModel)
    {
        return [
            'id' => $comprovacaoModel->compo_id,
            'diarias_utilizadas' => $comprovacaoModel->comp_diarias_utilizadas,
            'data_hora_saida_efetiva' => $comprovacaoModel->comp_data_hora_saida_efetiva,
            'data_hora_chegada_efetiva' => $comprovacaoModel->comp_data_hora_chegada_efetiva,
            'atividades_desenvolvidas' => $comprovacaoModel->comp_atividades_desenvolvidas,
            'saldo_receber' => $comprovacaoModel->comp_saldo_receber,
            'saldo_restituir' => $comprovacaoModel->comp_saldo_restituir,
            'valor_total' => $comprovacaoModel->comp_valor_total,
            'trecho' => $comprovacaoModel->id_trecho,
            
        ];
    }
}