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
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($comprovantes as $comprovante) {
            $dados['itens'][] = $this->tratarOutput($comprovante);
        }

        if (isset($input['count'])) {
            $dados['total'] = $comprovantes->total();
        } else {
            $dados['total'] = count($comprovantes);
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
            'compe_nome_arquivo' => $input['nome_arquivo'],
            'id_comprovacao' => $input['comprovacao'],
            'id_tipo_comprovante' => $input['tipo_comprovante'],
        ];
    }

    protected function tratarOutput(ComprovanteModel $comprovanteModel)
    {
        return [
            'id' => $comprovanteModel->compe_id,
            'caminho' => $comprovanteModel->compe_caminho,
            'nome_arquivo' => $comprovanteModel->compe_nome_arquivo,
            'comprovacao' => $comprovanteModel->id_comprovacao,
            'tipo_comprovante' => $comprovanteModel->id_tipo_comprovante,
        ];
    }
}