<?php
declare(strict_types=1);

namespace Diarias\Funcionario\Repositorios;

use Diarias\Funcionario\Models\FuncionarioModel;
use Exception;

class FuncionarioRepositorio
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

    public function find(int $id)
    {
        $model = $this->model->where('func_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Funcionário não encontrado');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $this->model->{$field} = $input[$field];
            }
        }
        $this->model->save();
        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $model->{$field} = $input[$field];
            }
        }
        $model->save();

        return $model;
    }

    public function delete(int $id, int $usuario)
    {
        $model = $this->find($id);

        $model->deleted_by = $usuario;
        $model->save();

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('func_nome', 'ASC');

        if (isset($input['func_nome']))
        {
            $model = $model->where('func_nome', 'ilike', '%'.$input['func_nome'].'%');
        }

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }
}
