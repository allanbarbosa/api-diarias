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
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($comprovacoes as $comprovacao) {
            $dados['itens'][] = $this->tratarOutput($comprovacao);
        }

        if (isset($input['count'])) {
            $dados['total'] = $comprovacoes->total();
        } else {
            $dados['total'] = count($comprovacoes);
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
            'compo_diarias_utilizadas' => $input['diarias_utilizadas'],
            'compo_data_hora_saida_efetiva' => $input['data_hora_saida_efetiva'],
            'compo_data_hora_chegada_efetiva' => $input['data_hora_chegada_efetiva'],
            'compo_atividades_desenvolvidas' => $input['atividades_desenvolvidas'],
            'compo_saldo_receber' => $input['saldo_receber'],
            'compo_saldo_restituir' => $input['saldo_restituir'],
            'compo_valor_total' => $input['valor_total'],
        ];
    }

    protected function tratarOutput(ComprovacaoModel $comprovacaoModel)
    {
        return [
            'id' => $comprovacaoModel->compo_id,
            'diarias_utilizadas' => $comprovacaoModel->compo_diarias_utilizadas,
            'data_hora_saida_efetiva' => $comprovacaoModel->compo_data_hora_saida_efetiva,
            'data_hora_chegada_efetiva' => $comprovacaoModel->compo_data_hora_chegada_efetiva,
            'atividades_desenvolvidas' => $comprovacaoModel->compo_atividades_desenvolvidas,
            'saldo_receber' => $comprovacaoModel->compo_saldo_receber,
            'saldo_restituir' => $comprovacaoModel->compo_saldo_restituir,
            'valor_total' => $comprovacaoModel->compo_valor_total,
            
        ];
    }
}