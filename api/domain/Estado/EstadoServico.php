<?php

declare(strict_types=1);

namespace Diarias\Estado;

use Diarias\Estado\Models\EstadoModel;
use Diarias\Estado\Repositorios\EstadoRepositorio;


class EstadoServico
{
    protected $repositorio;

    public function __construct(EstadoRepositorio $estadoRepositorio)
    {
        $this->repositorio = $estadoRepositorio;
    }

    public function find(int $id)
    {
        $estado = $this->repositorio->find($id);

        return $this->tratarOutput($estado);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $estado = $this->repositorio->save($dados);

        return $this->tratarOutput($estado);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['update_by'] = $input['usuario'];

        $estado = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($estado);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'esta_sigla' => $input['sigla'],
            'esta_nome' => $input['nome']
        ];

    }
    protected function tratarOutput(EstadoModel $estadoModel)
    {
        return [
            'id' => $estadoModel->esta_id,
            'sigla' => $estadoModel->esta_sigla,
            'nome' => $estadoModel->esta_nome,
        ];
    }

}
