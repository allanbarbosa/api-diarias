<?php
declare(strict_types=1);

namespace Diarias\Funcionario;

use Diarias\Funcionario\Models\FuncionarioModel;
use Diarias\Funcionario\Repositorios\FuncionarioRepositorio;

class FuncionarioServico
{
    protected $repositorio;

    public function __construct(FuncionarioRepositorio $funcionarioRepositorio)
    {
        $this->repositorio = $funcionarioRepositorio;
    }

    public function find($id)
    {
        $funcionario = $this->repositorio->find($id);

        return $this->tratarOutput($funcionario);
    }

    public function all(array $input)
    {
        $funcionarios = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'todos' => 0,
        ];

        foreach ($funcionarios as $funcionario)
        {
            $dados['itens'][] = $this->tratarOutput($funcionario);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $funcionarios->total();
        } 
        else
        {
            $dados['total'] = count($funcionarios);
        }
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $funcionario = $this->repositorio->save($dados);

        return $this->tratarOutput($funcionario);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updeted_by'] = $input['usuario'];

        $funcionario = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($funcionario);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'func_cpf' => $input['cpf'],
            'func_nome' => $input['nome'],
            'func_telefone' => $input['telefone'],
        ];
    }

    protected function tratarOutput(FuncionarioModel $funcionarioModel)
    {
        return [
            'id' => $funcionarioModel->func_id,
            'cpf' => $funcionarioModel->func_cpf,
            'nome' => $funcionarioModel->func_nome,
            'telefone' => $funcionarioModel->func_telefone,

        ];
    }
}