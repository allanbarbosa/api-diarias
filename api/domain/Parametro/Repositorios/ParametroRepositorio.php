<?php
declare(strict_types=1);

namespace Diarias\Parametro\Repositorios;

use Diarias\Parametro\Models\ParametroModel;
use Exception;

class ParametroRepositorio
{
    protected $model;

    protected $fields = [
        'para_max_diarias_mes',
        'para_max_diarias_ano',
        'para_max_diarias_consecutivas',
    ];

    public function __construct(ParametroModel $parametroModel)
    {
        $this->model = $parametroModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('para_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Parametro não encontrada.');
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

    public function delete(int $id)
    {
        $model = $this->find($id);

        return $model->delete();
    }
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('para_max_diarias_mes', 'para_max_diarias_ano', 'para_max_diarias_consecutivas', 'ASC');


        if (isset($input['para_max_diarias_mes'])) {
            $model = $model->where('para_max_diarias_mes', '=', '%'.$input['para_max_diarias_mes'].'%');
        }

        if (isset($input['para_max_diarias_ano'])) {
            $model = $model->where('para_max_diarias_ano', '=', '%'.$input['para_max_diarias_ano'].'%');
        }

        if (isset($input['para_max_diarias_consecutivas'])) {
            $model = $model->where('para_max_diarias_consecutivas', '=', '%'.$input['para_max_diarias_consecutivas'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}