<?php

declare(strict_types=1);

namespace Diarias\TipoComprovante;

use Diarias\TipoComprovante\Models\TipoComprovanteModel;
use Diarias\TipoComprovante\Repositorios\TipoComprovanteRepositorio;
use Illuminate\Support\Str;

class TipoComprovanteServico
{
    protected $repositorio;

    public function __construct(TipoComprovanteRepositorio $tipoComprovanteRepositorio)
    {
        $this->repositorio = $tipoComprovanteRepositorio;
    }

    public function find(int $id)
    {
        $tipoComprovante = $this->repositorio->find($id);

        return $this->tratarOutput($tipoComprovante);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $tipoComprovante = $this->repositorio->save($dados);

        return $this->tratarOutput($tipoComprovante);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $tipoComprovante = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($tipoComprovante);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'tipo_com_nome' => $input['nome'],
            'tipo_com_slug' => Str::slug($input['slug']),
        ];
    }

    protected function tratarOutput(TipoComprovanteModel $tipoComprovanteModel)
    {
        return [
            'id' => $tipoComprovanteModel->tipo_com_id,
            'nome' => $tipoComprovanteModel->tipo_com_nome,
            'slug' => $tipoComprovanteModel->tipo_com_slug,
        ];
    }
}
