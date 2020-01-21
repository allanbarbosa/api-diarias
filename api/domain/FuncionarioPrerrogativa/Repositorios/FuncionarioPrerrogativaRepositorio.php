<?php
declare(strict_types=1);

namespace Diarias\FuncionarioPrerrogativa\Repositorios;

use Diarias\FuncionarioPrerrogativa\Models\FuncionarioPrerrogativaModel;
use Exception;

class FuncionarioPrerrogativaRepositorio
{
    protected $model;

    protected $fields = [
        'func_pre_data_inicio',
        'func_pre_data_fim',
        'id_funcionario',
        'id_prerrogativa',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(FuncionarioPrerrogativaModel $funcionarioPrerrogativaModel)
    {
        $this->model = $funcionarioPrerrogativaModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('func_pre_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Prerrogativa de funcionário não encontrada.');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->model->{$field} = $input[$field];
            }
        }

        $this->model->save();

        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
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
        $model = $this->model->orderBy('func_pre_data_inicio', 'ASC');

        if (isset($input['func_pre_data_inicio'])) {
            $model = $model->where('func_pre_data_inicio', 'ilike', '%'.$input['func_pre_data_inicio'].'%');
        }

        return $model->get();
    }
}
