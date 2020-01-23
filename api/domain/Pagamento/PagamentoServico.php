<?php
declare(strict_types=1);

namespace Diarias\Pagamento;

use Diarias\Pagamento\Models\PagamentoModel;
use Diarias\Pagamento\Repositorios\PagamentoRepositorio;

class PagamentoServico
{
    protected $repositorio;

    public function __construct(PagamentoRepositorio $pagamentoRepositorio)
    {
        $this->repositorio = $pagamentoRepositorio;
    }

    public function find(int $id)
    {
        $pagamento = $this->repositorio->find($id);

        return $this->tratarOutput($pagamento);
    }

    public function all(array $input)
    {
        $pagamentos = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($pagamentos as $pagamento) {
            $dados[] = $this->tratarOutput($pagamento);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $pagamento = $this->repositorio->save($dados);

        return $this->tratarOutput($pagamento);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $pagamento = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($pagamento);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'paga_numero_pagamento' => $input['numeroPagamento'],
            'id_viagem' => $input['idViagem'],
        ];
    }

    protected function tratarOutput(PagamentoModel $pagamentoModel)
    {
        return [
            'id' => $pagamentoModel->paga_id,
            'numeroPagamento' => $pagamentoModel->paga_numero_pagamento,
            'idViagem' => $pagamentoModel->id_viagem,
            'viagem' =>
            [
                'id' => $pagamentoModel->viagem->viag_id,
                'objetivo' => $pagamentoModel->viagem->viag_objetivo,
                'justFeriado' => $pagamentoModel->viagem->viag_justificativa_feriado_fds,
                'justReprog' => $pagamentoModel->viagem->viag_justificativa_reprogramacao,
                'flagAliCust' => $pagamentoModel->viagem->viag_flag_alimentacao_custeada,
                'flagAdicDesl' => $pagamentoModel->viagem->viag_flag_adicional_deslocamento,
                'flagUrgente' => $pagamentoModel->viagem->viag_flag_urgente,
            ],
        ];
    }
}