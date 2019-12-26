<?php
declare(strict_types=1);

namespace Diarias\Cargo\Repositorios;

use Diarias\Cargo\Models\CargoModel;
use Exception;

class CargoRepositorio
{
    protected $model;

    protected $fields = [
        'carg_nome',
        'carg_slug',
        'id_gratificacao',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(CargoModel $cargoModel)
    {
        $this->model = $cargoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('carg_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Cargo não encontrado');
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
        $model = $this->model->orderBy('carg_nome', 'ASC');

        if (isset($input['carg_nome']))
        {
            $model = $model->where('carg_nome', 'ilike', '%'.$input['carg_nome'].'%');
        }

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }
}
