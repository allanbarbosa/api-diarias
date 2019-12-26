<?php

declare(strict_types=1);

namespace Diarias\Pais\Repositorios;

use Diarias\Pais\Models\PaisModel;
use Exception;

class PaisRepositorio
{
    protected $model;

    protected $fields = [
        'pais_nome',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(PaisModel $paisModel)
    {
        $this->model = $paisModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('pais_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Pais não encontrado.');
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
      $model = $this->model->orderBy('pais_nome', 'ASC');

      if (isset($input['pais_nome']))
      {
          $model = $model->where('pais_nome', 'ilike', '%'.$input['pais_nome'].'%');
      }

      if (isset($input['count']))
      {
          return $model->paginate($input['count']);
      }
      return $model->get();
    }
}

