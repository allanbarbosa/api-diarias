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
            'trec_rot_data_hora_saida' => $input['dataHoraSaida'],
            'trec_rot_data_hora_retorno' => $input['dataHoraRetorno'],
            'trec_rot_valor_unitario' => $input['valorUnitario'],
            'trec_rot_valor_adicional' => isset($input['valorAdicional']) ? $input['valorAdicional'] : null,
            'trec_rot_qtd_diarias' => $input['qtdDiarias'],
            'id_tipo_transporte' => $input['idTipoTransporte'],
            'id_viagem' => $input['idViagem'],
            'id_pais_origem' => $input['idPaisOrigem'],
            'id_municipio_origem' => $input['idMunicipioOrigem'],
            'id_pais_destino' => $input['idPaisDestino'],
            'id_municipio_destino' => $input['idMunicipioDestino'],

        ];
    }

    protected function tratarOutput(TrechoRoteiroModel $trechoRoteiroModel)
    {
        return [
            'id' => $trechoRoteiroModel->trec_rot_id,
            'dataHoraSaida' => $trechoRoteiroModel->trec_rot_data_hora_saida,
            'dataHoraRetorno' => $trechoRoteiroModel->trec_rot_data_hora_retorno,
            'valorUnitario' => $trechoRoteiroModel->trec_rot_valor_unitario,
            'valorAdicional' => $trechoRoteiroModel->trec_rot_valor_adicional,
            'qtdDiarias' => $trechoRoteiroModel->trec_rot_qtd_diarias,
            'idTipoTransporte' => $trechoRoteiroModel->id_tipo_transporte,
            'tipo_transporte' =>
            [
                'id' => $trechoRoteiroModel->tipo_transporte->tipo_tra_id,
                'nome' => $trechoRoteiroModel->tipo_transporte->tipo_tra_nome,
                'slug' => $trechoRoteiroModel->tipo_transporte->tipo_tra_slug
            ],
            'idViagem' => $trechoRoteiroModel->id_viagem,
            'viagem' =>
            [
                'id' => $trechoRoteiroModel->viagem->viag_id,
                'objetivo' => $trechoRoteiroModel->viagem->viag_objetivo,
                'justFeriado' => $trechoRoteiroModel->viagem->viag_justificativa_feriado_fds,
                'justReprog' => $trechoRoteiroModel->viagem->viag_justificativa_reprogramacao,
                'flagAliCust' => $trechoRoteiroModel->viagem->viag_flag_alimentacao_custeada,
                'flagAdicDesl' => $trechoRoteiroModel->viagem->viag_flag_adicional_deslocamento,
                'flagUrgente' => $trechoRoteiroModel->viagem->viag_flag_urgente
            ],
            'idPaisOrigem' => $trechoRoteiroModel->id_pais_origem,
            'idPaisDestino' => $trechoRoteiroModel->id_pais_destino,
            'pais' =>
            [
                'id' => $trechoRoteiroModel->pais->pais_id,
                'nome' => $trechoRoteiroModel->pais->pais_nome
            ],
            'idMunicipioOrigem' => $trechoRoteiroModel->id_municipio_origem,
            'idMunicipioDestino' => $trechoRoteiroModel->id_municipio_destino,
            'municipio' =>
            [
                'id' => $trechoRoteiroModel->municipio->muni_id,
                'nome' => $trechoRoteiroModel->municipio->muni_nome,
                'slug' => $trechoRoteiroModel->municipio->muni_slug,
            ]
        ];
    }
}
