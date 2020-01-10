<?php
declare(strict_types=1);

namespace Diarias\Ferias\Repositorios;

use Diarias\Ferias\Models\FeriasModel;
use Exception;

class FeriasRepositorio
{
    protected $model;

    protected $fields = [
        'feri_data_inicio',
        'feri_data_fim',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(FeriasModel $feriasModel)
    {
        $this->model = $feriasModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('feri_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Férias não encontrada.');
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
        $model = $this->model->orderBy('feri_data_inicio', 'ASC');

        if (isset($input['feri_data_inicio'])) {
            $model = $model->where('feri_data_inicio', 'ilike', '%'.$input['feri_data_inicio'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}