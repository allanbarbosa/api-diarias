<?php
declare(strict_types=1);

namespace Diarias\HistoricoMovimentacao\Repositorios;

use Diarias\HistoricoMovimentacao\Models\HistoricoMovimentacaoModel;
use Exception;

class HistoricoMovimentacaoRepositorio
{
    protected $model;

    protected $fields = [
        'hist_mov_data_tramitacao',
        'hist_mov_observacao',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(HistoricoMovimentacaoModel $historicoMovimentacao)
    {
        $this->model = $historicoMovimentacao;
    }

    public function find(int $id)
    {
        $model = $this->model->where('hist_mov_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Historico movimentação não encontrada.');
        }

        return $model;
    }

    public function all()
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
        $model = $this->model->orderBy('hist_mov_data_tramitacao', 'ASC');

        if (isset($input['hist_mov_data_tramitacao'])) {
            $model = $model->where('hist_mov_data_tramitacao', 'ilike', '%'.$input['hist_mov_data_tramitacao'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}