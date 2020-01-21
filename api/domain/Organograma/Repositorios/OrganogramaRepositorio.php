<?php

declare (strict_types = 1);

namespace Diarias\Organograma\Repositorios;

use Diarias\Organograma\Models\OrganogramaModel;
use Exception;

class OrganogramaRepositorio
{
    protected $model;

    protected $fields = [
        'orga_codigo',
        'orga_data_inicio',
        'orga_data_fim',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(OrganogramaModel $organograma)
    {
        $this->model = $organograma;
    }

    public function find(int $id)
    {
        $model = $this->model->where('orga_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Organograma não encontrado.');
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
        $model = $this->model->orderby('orga_codigo', 'ASC');

        if (isset($input['orga_codigo'])) {
            $model = $model->where('orga_codigo', 'ilike', '%' . $input['orga_codigo'] . '%');
        }

        return $model->get();

    }

    public function obterOrganogramaAtual()
    {
        return $this->model->where('orga_data_fim', null)->orderby('orga_data_inicio', 'DESC')->first();
    }

}
