<?php
declare(strict_types=1);

namespace Diarias\TipoTransporte\Repositorios;

use Diarias\TipoTransporte\Models\TipoTransporteModel;
use Exception;



class TipoTransporteRepositorio
{
    protected $model;

    protected $fields = [
        'tipo_tra_nome',
        'tipo_tra_slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(TipoTransporteModel $tipoTransporteModel)
    {
        $this->model = $tipoTransporteModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('tipo_tra_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Tipo de transporte não encontrado.');
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
        $model = $this->model->orderBy('tipo_tra_nome', 'ASC');

        if (isset($input['tipo_tra_nome'])) {
            $model = $model->where('tipo_tra_nome', 'ilike', '%'.$input['tipo_tra_nome'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}
