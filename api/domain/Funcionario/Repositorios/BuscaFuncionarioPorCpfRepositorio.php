<?php
declare(strict_types=1);

namespace Diarias\Funcionario\Repositorios;

use Diarias\Funcionario\Models\FuncionarioModel;
use Exception;

class BuscaFuncionarioPorCpfRepositorio
{
    protected $model;

    protected $fields = [
        'func_cpf',
        'func_nome',
        'func_telefone',
        'func_email',
        'id_empresa',
        'id_profissao',
        'id_escolaridade',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(FuncionarioModel $funcionarioModel)
    {
        $this->model = $funcionarioModel;
    }

    public function find($cpf)
    {
        $model = $this->model->where('func_cpf', '=', $cpf)->first();

        if (!$model)
        {
            throw new Exception('Funcionário não encontrado');
        }

        return $model;
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('func_cpf', 'ASC');

        if (isset($input['func_cpf']))
        {
            $model = $model->where('func_cpf', 'ilike', '%'.$input['func_cpf'].'%');
        }

        return $model->get();
    }
}