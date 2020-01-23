<?php
declare(strict_types=1);

namespace Diarias\FuncionarioPrerrogativa;

use Diarias\FuncionarioPrerrogativa\Models\FuncionarioPrerrogativaModel;
use Diarias\FuncionarioPrerrogativa\Repositorios\FuncionarioPrerrogativaRepositorio;

class FuncionarioPrerrogativaServico
{
    protected $repositorio;

    public function __construct(FuncionarioPrerrogativaRepositorio $funcionarioPrerrogativaRepositorio)
    {
        $this->repositorio = $funcionarioPrerrogativaRepositorio;
    }

    public function find(int $id)
    {
        $funcionarioPrerrogativa = $this->repositorio->find($id);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function all(array $input)
    {
        $funcionarioPrerrogativas = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($funcionarioPrerrogativas as $funcionarioPrerrogativa) {
            $dados[] = $this->tratarOutput($funcionarioPrerrogativa);
        }
        
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $funcionarioPrerrogativa = $this->repositorio->save($dados);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $funcionarioPrerrogativa = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'func_pre_data_inicio' => $input['dataInicio'],
            'func_pre_data_fim' => $input['dataFim'],
            'id_funcionario' => $input['idFuncionario'],
            'id_prerrogativa' => $input['idPrerrogativa'],
        ];
    }

    protected function tratarOutput(FuncionarioPrerrogativaModel $funcionarioPrerrogativaModel)
    {
        return [
            'id' => $funcionarioPrerrogativaModel->func_pre_id,
            'dataInicio' => $funcionarioPrerrogativaModel->func_pre_data_inicio,
            'dataFim' => $funcionarioPrerrogativaModel->func_pre_data_fim,
            'idFuncionario' => $funcionarioPrerrogativaModel->id_funcionario,
            'funcionario' =>
            [
                'id' => $funcionarioPrerrogativaModel->funcionario->func_id,
                'cpf' => $funcionarioPrerrogativaModel->funcionario->func_cpf,
                'nome' => $funcionarioPrerrogativaModel->funcionario->func_nome,
                'telefone' => $funcionarioPrerrogativaModel->funcionario->func_telefone,
                'email' => $funcionarioPrerrogativaModel->funcionario->func_email,
            ],
            'idPrerrogativa' => $funcionarioPrerrogativaModel->id_prerrogativa,
            'prerrogativa' =>
            [
                'id' => $funcionarioPrerrogativaModel->prerrogativa->prer_id,
                'descricao' => $funcionarioPrerrogativaModel->prerrogativa->prer_descricao,
                'slug' => $funcionarioPrerrogativaModel->prerrogativa->prer_slug,
            ]
        ];
    }
}
