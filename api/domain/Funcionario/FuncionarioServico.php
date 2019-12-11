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

    public function find(int $id)
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
        $dados['updated_by'] = $input['usuario'];

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
            'id_empresa' => $input['empresa'],
            'id_profissao' => $input['profissao'],
            'id_escolaridade' => $input['escolaridade']
        ];
    }

    protected function tratarOutput(FuncionarioModel $funcionarioModel)
    {
        return [
            'id' => $funcionarioModel->func_id,
            'cpf' => $funcionarioModel->func_cpf,
            'nome' => $funcionarioModel->func_nome,
            'telefone' => $funcionarioModel->func_telefone,
            'empresa' =>
            [
                'id' => $funcionarioModel->id_empresa,
                'descricao' => $funcionarioModel->empresa->empr_nome,
            ],
            'profissao' =>
            [
                'id' => $funcionarioModel->id_profissao,
                'descricao' => $funcionarioModel->profissao->prof_nome,
            ],
            'escolaridade' =>
            [
                'id' => $funcionarioModel->id_escolaridade,
                'descricao' => $funcionarioModel->escolaridade->esco_nome,
            ],
        ];
    }
}