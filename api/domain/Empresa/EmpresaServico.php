<?php
declare(strict_types=1);

namespace Diarias\Empresa;

use Diarias\Empresa\Models\EmpresaModel;
use Diarias\Empresa\Repositorios\EmpresaRepositorio;

class EmpresaServico
{
    protected $repositorio;

    public function __construct(EmpresaRepositorio $empresaRepositorio)
    {
        $this->repositorio = $empresaRepositorio;
    }

    public function find(int $id)
    {
        $empresa = $this->repositorio->find($id);

        return $this->tratarOutput($empresa);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $empresa = $this->repositorio->save($dados);

        return $this->tratarOutput($empresa);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $empresa = $this->repositorio->save($dados, $id);

        return $this->tratarOutput($empresa);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'empr_nome' => $input['nome'],
            'empr_sigla' => $input['sigla'],
        ];
    }

    protected function tratarOutput(EmpresaModel $empresaModel)
    {
        return [
            'id' => $empresaModel->empr_id,
            'nome' => $empresaModel->empr_nome,
            'sigla' => $empresaModel->empr_sigla,
        ];

    }
}
