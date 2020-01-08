<?php
declare(strict_types=1);

namespace Diarias\Comprovacao\Repositorios;

use Diarias\Comprovacao\Models\ComprovacaoModel;
use Exception;

class ComprovacaoRepositorio
{
    protected $model;

    protected $fields = [
        'compo_diarias_utilizadas',
        'compo_data_hora_saida_efetiva',
        'compo_data_hora_chegada_efetiva',
        'compo_atividades_desenvolvidas',
        'compo_saldo_receber',
        'compo_saldo_restituir',
        'compo_valor_total',
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
        $model = $this->model->orderBy('compo_diarias_utilizadas', 'ASC');

        if (isset($input['compo_diarias_utilizadas'])) {
            $model = $model->where('compo_diarias_utilizadas', 'ilike', '%'.$input['compo_diarias_utilizadas'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}