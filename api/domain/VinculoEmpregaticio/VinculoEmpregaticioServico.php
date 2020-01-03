<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Diarias\VinculoEmpregaticio\Repositorios\VinculoEmpregaticioRepositorio;

class VinculoEmpregaticioServico
{
    protected $repositorio;

    public function __construct(VinculoEmpregaticioRepositorio $vinculoEmpregaticioRepositorio)
    {
        $this->repositorio = $vinculoEmpregaticioRepositorio;
    }

    public function find(int $id)
    {
        $vinculoEmpregaticio = $this->repositorio->find($id);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function all(array $input)
    {
        $vinculosEmpregaticios = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'todos' => 0,
        ];

        foreach ($vinculosEmpregaticios as $vinculoEmpregaticio)
        {
            $dados['itens'][] = $this->tratarOutput($vinculoEmpregaticio);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $vinculosEmpregaticios->total();
        } 
        else
        {
            $dados['total'] = count($vinculosEmpregaticios);
        }
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $vinculoEmpregaticio = $this->repositorio->save($dados);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $vinculoEmpregaticio = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'vinc_emp_matricula' => $input['matricula'],
            'vinc_emp_data_admissao' => $input['dataAdmissao'],
            'id_funcionario' => $input['funcionario'],
            'vinc_emp_data_desligamento' => $input['dataDesligamento']
        ];
    }

    protected function tratarOutput(VinculoEmpregaticioModel $vinculoEmpregaticioModel)
    {
        return [
            'id' => $vinculoEmpregaticioModel->vinc_emp_id,
            'matricula' => $vinculoEmpregaticioModel->vinc_emp_matricula,
            'dataAdmissao' => $vinculoEmpregaticioModel->vinc_emp_data_admissao,
            'dataDesligamento' => $vinculoEmpregaticioModel->vinc_emp_data_desligamento,
            'funcionario' =>
            [
                'id' => $vinculoEmpregaticioModel->id_funcionario,
                'cpf' => $vinculoEmpregaticioModel->funcionario->func_cpf,
                'nome' => $vinculoEmpregaticioModel->funcionario->func_nome
            ]
        ];
    }
}