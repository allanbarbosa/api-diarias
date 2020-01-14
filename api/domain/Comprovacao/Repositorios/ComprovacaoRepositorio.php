<?php
declare(strict_types=1);

namespace Diarias\Comprovacao\Repositorios;

use Diarias\Comprovacao\Models\ComprovacaoModel;
use Exception;

class ComprovacaoRepositorio
{
    protected $model;

    protected $fields = [
        'comp_diarias_utilizadas',
        'comp_data_hora_saida_efetiva',
        'comp_data_hora_chegada_efetiva',
        'comp_atividades_desenvolvidas',
        'comp_saldo_receber',
        'comp_saldo_restituir',
        'comp_valor_total',
        'id_trecho',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(ComprovacaoModel $comprovacaoModel)
    {
        $this->model = $comprovacaoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('compo_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Comprovação não encontrada.');
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
        $model = $this->model->orderBy('comp_diarias_utilizadas', 'ASC');

        if (isset($input['comp_diarias_utilizadas'])) {
            $model = $model->where('comp_diarias_utilizadas', 'ilike', '%'.$input['comp_diarias_utilizadas'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}