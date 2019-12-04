<?php
declare(strict_types=1);

namespace Diarias\Perfil\Repositorios;

use Diarias\Perfil\Models\PerfilModel;
use Exception;

class PerfilRepositorio
{
    protected $model;

    protected $fields = [
        'perf_descricao',
        'perf_slug',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function __construct(PerfilModel $perfilModel)
    {
        $this->model = $$perfilModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('perf_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Perfil não encontrada.');
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
        $model = $this->model->orderBy('perf_descricao', 'ASC');

        if (isset($input['perf_descricao'])) {
            $model = $model->where('perf_descricao', 'ilike', '%'.$input['perf_descricao'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}
