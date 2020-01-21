<?php
declare(strict_types=1);

namespace Diarias\HistoricoStatus\Repositorios;

use Diarias\HistoricoStatus\Models\HistoricoStatusModel;
use Exception;

class HistoricoStatusRepositorio
{
    protected $model;

    protected $fields = [
        'hist_sta_data_tramitacao',
        'hist_sta_observacao',
        'id_viagem',
        'id_status',
        'id_lotacao',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(HistoricoStatusModel $historicoStatusModel)
    {
        $this->model = $historicoStatusModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('hist_sta_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Histórico status não encontrada.');
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
        $model = $this->model->orderBy('hist_sta_data_tramitacao', 'ASC');

        if (isset($input['hist_sta_data_tramitacao'])) {
            $model = $model->where('hist_sta_data_tramitacao', 'ilike', '%'.$input['hist_sta_data_tramitacao'].'%');
        }

        return $model->get();
    }
}