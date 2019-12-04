<?php
declare(strict_types=1);

namespace Diarias\Status\Repositorios;

use Diarias\Status\Models\StatusModel;
use Exception;

class StatusRepositorio
{
    protected $model;

    protected $fields = [
        'stat_nome',
        'stat_slug',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function __construct(StatusModel $statusModel)
    {
        $this->model = $statusModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('stat_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Status não encontrada.');
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
        $model = $this->model->orderBy('stat_nome', 'ASC');

        if (isset($input['stat_nome'])) {
            $model = $model->where('stat_nome', 'ilike', '%'.$input['stat_nome'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}
