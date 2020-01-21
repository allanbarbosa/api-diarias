<?php

declare(strict_types=1);

namespace Diarias\TipoComprovante\Repositorios;

use Diarias\TipoComprovante\Models\TipoComprovanteModel;
use Exception;

class TipoComprovanteRepositorio
{
    protected $model;

    protected $fields = [
        'tipo_com_nome',
        'tipo_com_slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(TipoComprovanteModel $tipoComprovanteModel)
    {
        $this->model = $tipoComprovanteModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('tipo_com_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Tipo de comprovante não encontrada.');
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
        $model = $this->model->orderBy('tipo_com_nome', 'ASC');

        if (isset($input['tipo_com_nome'])) {
            $model = $model->where('tipo_com_nome', 'ilike', '%'.$input['tipo_com_nome'].'%');
        }

        return $model->get();
    }
}