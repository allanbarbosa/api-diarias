<?php

declare(strict_types=1);

namespace Diarias\Particularidade\Repositorios;

use Diarias\Particularidade\Models\ParticularidadeModel;
use Exception;

class ParticularidadeRepositorio
{
    protected $model;

    protected $fields = [
        'prer_descricao',
        'prer_slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(ParticularidadeModel $particularidadeModel)
    {
        $this->model = $particularidadeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('part_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Particularidade não encontrada.');
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
        $model = $this->model->orderBy('part_descricao', 'ASC');

        if (isset($input['part_descricao'])) {
            $model = $model->where('part_descricao', 'ilike', '%'.$input['part_descricao'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}