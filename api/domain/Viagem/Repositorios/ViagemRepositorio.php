<?php
declare(strict_types=1);

namespace Diarias\Viagem\Repositorios;

use Diarias\Viagem\Models\ViagemModel;
use Exception;

class ViagemRepositorio
{
    protected $model;

    protected $fields = [
        'viag_objetivo',
        'viag_justificativa_feriado_fds',
        'viag_justificativa_reprogramacao',
        'viag_flag_alimentacao_custeada',
        'viag_flag_adicional_deslocamento',
        'viag_flag_urgente',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(ViagemModel $viagemModel)
    {
        $this->model = $viagemModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('viag_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Viagem não encontrada.');
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
        $model = $this->model->orderBy('viag_objetivo', 'ASC');

        if (isset($input['viag_objetivo'])) {
            $model = $model->where('viag_objetivo', 'ilike', '%'.$input['viag_objetivo'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}