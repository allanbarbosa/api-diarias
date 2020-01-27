<?php
declare(strict_types=1);

namespace Diarias\Funcionario;

use Diarias\Funcionario\Models\FuncionarioModel;
use Diarias\Funcionario\Repositorios\BuscaFuncionarioPorCpfRepositorio;

class BuscaFuncionarioPorCpfServico
{
    protected $repositorio;

    public function __construct(BuscaFuncionarioPorCpfRepositorio $buscaFuncionarioPorCpfRepositorio)
    {
        $this->repositorio = $buscaFuncionarioPorCpfRepositorio;
    }

    public function find($cpf)
    {
        $funcionario = $this->repositorio->find($cpf);

        return $this->tratarOutput($funcionario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'func_cpf' => $input['cpf']
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