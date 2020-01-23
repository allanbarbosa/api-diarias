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
            'comp_diarias_utilizadas' => $input['diariasUtilizadas'],
            'comp_data_hora_saida_efetiva' => $input['dataHoraSaidaEfetiva'],
            'comp_data_hora_chegada_efetiva' => $input['dataHoraChegadaEfetiva'],
            'comp_atividades_desenvolvidas' => $input['atividadesDesenvolvidas'],
            'comp_saldo_receber' => isset($input['saldoReceber']) ? $input['saldoReceber'] : null,
            'comp_saldo_restituir' => isset($input['saldoRestituir']) ? $input['saldoRestituir'] : null,
            'comp_valor_total' => isset($input['valorTotal']) ? $input['valorTotal'] : null,
            'id_trecho' => $input['idTrecho'],
        ];
    }

    protected function tratarOutput(ComprovacaoModel $comprovacaoModel)
    {
        return [
            'id' => $comprovacaoModel->compo_id,
            'diariasUtilizadas' => $comprovacaoModel->comp_diarias_utilizadas,
            'dataHoraSaidaEfetiva' => $comprovacaoModel->comp_data_hora_saida_efetiva,
            'dataHoraChegadaEfetiva' => $comprovacaoModel->comp_data_hora_chegada_efetiva,
            'atividadesDesenvolvidas' => $comprovacaoModel->comp_atividades_desenvolvidas,
            'saldoReceber' => $comprovacaoModel->comp_saldo_receber,
            'saldoRestituir' => $comprovacaoModel->comp_saldo_restituir,
            'valorTotal' => $comprovacaoModel->comp_valor_total,
            'idTrecho' => $comprovacaoModel->id_trecho,
            'trecho_roteiro' =>
            [
            'id' => $comprovacaoModel->trecho_roteiro->trec_rot_id,
            'dataHoraSaida' => $comprovacaoModel->trecho_roteiro->trec_rot_data_hora_saida,
            'dataHoraRetorno' => $comprovacaoModel->trecho_roteiro->trec_rot_data_hora_retorno,
            'valorUnitario' => $comprovacaoModel->trecho_roteiro->trec_rot_valor_unitario,
            'valorAdicional' => $comprovacaoModel->trecho_roteiro->trec_rot_valor_adicional,
            'qtdDiarias' => $comprovacaoModel->trecho_roteiro->trec_rot_qtd_diarias
            ]
            
        ];
    }
}