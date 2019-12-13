<?php

declare(strict_types=1);

namespace Diarias\Estado\Repositorios;

use Diarias\Estado\Models\EstadoModel;
use Exception;

class EstadoRepositorio
{
    protected $model;

    protected $fields = [
        'esta_sigla',
        'esta_nome',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(EstadoModel $estadoModel)
    {
        $this->model = $estadoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('esta_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Estado não encontrado.');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach($this->fields as $field) {
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
        $model = $this->model->orderBy('esta_sigla', 'ASC');

        if (isset($input['esta_sigla'])) {
            $model = $model->where('esta_sigla', 'ilike', '%'.$input['esta_sigla'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }
        return $model->get();
    }
}

