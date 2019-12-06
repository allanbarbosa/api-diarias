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
        $empresas = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($empresas as $empresa)
        {
            $dados['itens'][] = $this->tratarOutput($empresa);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $empresas->total();
        }
        else
        {
            $dados['total'] = count($empresas);
        }

        return $dados;
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
            'empr_nome' => $input['empresa'],
            'empr_sigla' => $input['sigla'],
        ];
    }

    protected function tratarOutput(EmpresaModel $empresaModel)
    {
        return [
            'id' => $empresaModel->empr_id,
            'empresa' => $empresaModel->empr_nome,
            'sigla' => $empresaModel->empr_sigla,
        ];

    }
}