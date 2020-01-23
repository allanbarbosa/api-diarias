<?php
declare(strict_types=1);

namespace Diarias\Comprovante;

use Diarias\Comprovante\Models\ComprovanteModel;
use Diarias\Comprovante\Repositorios\ComprovanteRepositorio;


class ComprovanteServico
{
    protected $repositorio;

    public function __construct(ComprovanteRepositorio $comprovanteRepositorio)
    {
        $this->repositorio = $comprovanteRepositorio;
    }

    public function find(int $id)
    {
        $comprovante = $this->repositorio->find($id);

        return $this->tratarOutput($comprovante);
    }

    public function all(array $input)
    {
        $comprovantes = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($comprovantes as $comprovante) {
            $dados[] = $this->tratarOutput($comprovante);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $comprovante = $this->repositorio->save($dados);

        return $this->tratarOutput($comprovante);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $comprovante = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($comprovante);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'compe_caminho' => $input['caminho'],
            'compe_nome_arquivo' => $input['nomeArquivo'],
            'id_comprovacao' => $input['idComprovacao'],
            'id_tipo_comprovante' => $input['idTipoComprovante'],
        ];
    }

    protected function tratarOutput(ComprovanteModel $comprovanteModel)
    {
        return [
            'id' => $comprovanteModel->compe_id,
            'caminho' => $comprovanteModel->compe_caminho,
            'nomeArquivo' => $comprovanteModel->compe_nome_arquivo,
            'idComprovacao' => $comprovanteModel->id_comprovacao,
            'comprovacao' => 
            [
                'id' => $comprovanteModel->comprovacao->compo_id,
                'diariasUtilizadas' => $comprovanteModel->comprovacao->comp_diarias_utilizadas,
                'dataHoraSaidaEfetiva' => $comprovanteModel->comprovacao->comp_data_hora_saida_efetiva,
                'dataHoraChegadaEfetiva' => $comprovanteModel->comprovacao->comp_data_hora_chegada_efetiva,
                'atividadesDesenvolvidas' => $comprovanteModel->comprovacao->comp_atividades_desenvolvidas,
                'saldoReceber' => $comprovanteModel->comprovacao->comp_saldo_receber,
                'saldoRestituir' => $comprovanteModel->comprovacao->comp_saldo_restituir,
                'valorTotal' => $comprovanteModel->comprovacao->comp_valor_total
            ],
            'idTipoComprovante' => $comprovanteModel->id_tipo_comprovante,
            'tipo_comprovante' =>
            [
                'id' => $comprovanteModel->tipo_comprovante->tipo_com_id,
                'nome' => $comprovanteModel->tipo_comprovante->tipo_com_nome,
                'slug' => $comprovanteModel->tipo_comprovante->tipo_com_slug
            ]
        ];
    }
}