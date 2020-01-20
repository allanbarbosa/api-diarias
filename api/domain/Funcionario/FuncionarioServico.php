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
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
            'func_cpf' => isset($input['cpf']) ? $input['cpf'] : null,
            'func_nome' => isset($input['nome']) ? $input['nome'] : null,
            'func_telefone' => isset($input['telefone']) ? $input['telefone'] : null,
            'func_email' => isset($input['email']) ? $input['email'] : null,
            'id_empresa' => isset($input['empresa']) ? $input['empresa'] : null,
            'id_profissao' => isset($input['profissao']) ? $input['profissao'] : null,
            'id_escolaridade' => isset($input['escolaridade']) ? $input['escolaridade'] : null
        ];
    }

    protected function tratarOutput(FuncionarioModel $funcionarioModel)
    {
        return [
            'id' => $funcionarioModel->func_id,
            'cpf' => $funcionarioModel->func_cpf,
            'nome' => $funcionarioModel->func_nome,
            'telefone' => $funcionarioModel->func_telefone,
            'email' => $funcionarioModel->func_email,
            'empresa' =>
            [
                'id' => $funcionarioModel->id_empresa,
                'nome' => $funcionarioModel->empresa->empr_nome,
                'sigla' => $funcionarioModel->empresa->empr_sigla
            ],
            'profissao' =>
            [
                'id' => $funcionarioModel->id_profissao,
                'nome' => $funcionarioModel->profissao->prof_nome,
                'slug' => $funcionarioModel->profissao->prof_slug
            ],
            'escolaridade' =>
            [
                'id' => $funcionarioModel->id_escolaridade,
                'nome' => $funcionarioModel->escolaridade->esco_nome,
                'slug' => $funcionarioModel->escolaridade->esco_slug
            ],
        ];
    }
}