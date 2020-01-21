<?php

declare(strict_types=1);

namespace Diarias\PapelFluxograma\Repositorios;

use Diarias\PapelFluxograma\Models\PapelFluxogramaModel;
use Exception;

class PapelFluxogramaRepositorio
{
    protected $model;

    protected $fields = [
        'pape_flu_slug',
        'pape_flu_descricao',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function __construct(PapelFluxogramaModel $papelFluxogramaModel)
    {
        $this->model = $papelFluxogramaModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('pape_flu_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Papel Fluxograma não encontrada.');
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

        foreach($this->fields as $field) {
            if (isset($input[$field])){
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
        $model = $this->model->orderBy('pape_flu_descricao', 'ASC');

        if (isset($input['pape_flu_descricao'])) {
            $model = $model->where('pape_flu_descricao', 'ilike', '%'.$input['pape_flu_descricao'].'%');
        }

        return $model->get();
    }

}