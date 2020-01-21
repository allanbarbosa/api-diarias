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
            'func_cpf' => $input['cpf'],
            'func_nome' => $input['nome'],
            'func_telefone' => isset($input['telefone']) ? $input['telefone'] : null,
            'func_email' => $input['email'],
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
            'email' => $funcionarioModel->func_email,
            'idEmpresa' => $funcionarioModel->id_empresa,
            'idProfissao' => $funcionarioModel->id_profissao,
            'idEscolaridade' => $funcionarioModel->id_escolaridade,
            'empresa' =>
            [
                'id' => $funcionarioModel->empresa->empr_id,
                'nome' => $funcionarioModel->empresa->empr_nome,
                'sigla' => $funcionarioModel->empresa->empr_sigla
            ],
            'profissao' =>
            [
                'id' => $funcionarioModel->profissao->prof_id,
                'nome' => $funcionarioModel->profissao->prof_nome,
                'slug' => $funcionarioModel->profissao->prof_slug
            ],
            'escolaridade' =>
            [
                'id' => $funcionarioModel->escolaridade->esco_id,
                'nome' => $funcionarioModel->escolaridade->esco_nome,
                'slug' => $funcionarioModel->escolaridade->esco_slug
            ],
        ];
    }
}