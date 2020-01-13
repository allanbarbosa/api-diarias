<?php
declare(strict_types=1);

namespace Diarias\TrechoRoteiro;

use Diarias\TrechoRoteiro\Models\TrechoRoteiroModel;
use Diarias\TrechoRoteiro\Repositorios\TrechoRoteiroRepositorio;

class TrechoRoteiroServico
{
    protected $repositorio;

    public function __construct(TrechoRoteiroRepositorio $trechoRoteiroRepositorio)
    {
        $this->repositorio = $trechoRoteiroRepositorio;
    }

    public function find(int $id)
    {
        $trechoRoteiro = $this->repositorio->find($id);

        return $this->tratarOutput($trechoRoteiro);
    }

    public function all(array $input)
    {
        $trechoRoteiros = $this->repositorio->getWhere($input);
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($trechoRoteiros as $trechoRoteiro) {
            $dados['itens'][] = $this->tratarOutput($trechoRoteiro);
        }

        if (isset($input['count'])) {
            $dados['total'] = $trechoRoteiros->total();
        } else {
            $dados['total'] = count($trechoRoteiros);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $trechoRoteiro = $this->repositorio->save($dados);

        return $this->tratarOutput($trechoRoteiro);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $trechoRoteiro = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($trechoRoteiro);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'trec_rot_data_hora_saida' => $input['data_hora_saida'],
            'trec_rot_data_hora_retorno' => $input['data_hora_retorno'],
            'trec_rot_valor_unitario' => $input['valor_unitario'],
            'trec_rot_valor_adicional' => $input['valor_adicional'],
            'trec_rot_qtd_diarias' => $input['qtd_diarias'],

        ];
    }

    protected function tratarOutput(TrechoRoteiroModel $prerrogativaModel)
    {
        return [
            'id' => $prerrogativaModel->trec_rot_id,
            'data_hora_saida' => $prerrogativaModel->trec_rot_data_hora_saida,
            'data_hora_retorno' => $prerrogativaModel->trec_rot_data_hora_retorno,
            'valor_unitario' => $prerrogativaModel->trec_rot_valor_unitario,
            'valor_adicional' => $prerrogativaModel->trec_rot_valor_adicional,
            'qtd_diarias' => $prerrogativaModel->trec_rot_qtd_diarias,
        ];
    }
}