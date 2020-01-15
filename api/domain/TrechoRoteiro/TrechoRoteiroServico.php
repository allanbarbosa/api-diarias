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
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
            'id_tipo_transporte' => $input['tipo_transporte'],
            'id_viagem' => $input['viagem'],
            'id_pais_origem' => $input['pais_origem'],
            'id_municipio_origem' => $input['municipio_origem'],
            'id_pais_destino' => $input['pais_destino'],
            'id_municipio_destino' => $input['municipio_destino'],

        ];
    }

    protected function tratarOutput(TrechoRoteiroModel $trechoRoteiroModel)
    {
        return [
            'id' => $trechoRoteiroModel->trec_rot_id,
            'data_hora_saida' => $trechoRoteiroModel->trec_rot_data_hora_saida,
            'data_hora_retorno' => $trechoRoteiroModel->trec_rot_data_hora_retorno,
            'valor_unitario' => $trechoRoteiroModel->trec_rot_valor_unitario,
            'valor_adicional' => $trechoRoteiroModel->trec_rot_valor_adicional,
            'qtd_diarias' => $trechoRoteiroModel->trec_rot_qtd_diarias,
            'tipo_transporte' => $trechoRoteiroModel->id_tipo_transporte,
            'viagem' => $trechoRoteiroModel->id_viagem,
            'pais_origem' => $trechoRoteiroModel->id_pais_origem,
            'municipio_origem' => $trechoRoteiroModel->id_municipio_origem,
            'pais_destino' => $trechoRoteiroModel->id_pais_destino,
            'municipio_destino' => $trechoRoteiroModel->id_municipio_destino,
        ];
    }
}