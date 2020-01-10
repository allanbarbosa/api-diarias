<?php
declare(strict_types=1);

namespace Diarias\Pagamento\Repositorios;

use Diarias\Pagamento\Models\PagamentoModel;
use Exception;

class PagamentoRepositorio
{
    protected $model;

    protected $fields = [
        'paga_numero_pagamento',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(PagamentoModel $pagamentoModel)
    {
        $this->model = $pagamentoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('paga_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Pagamento não encontrada.');
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
        $model = $this->model->orderBy('paga_numero_pagamento', 'ASC');

        if (isset($input['paga_numero_pagamento'])) {
            $model = $model->where('paga_numero_pagamento', 'ilike', '%'.$input['paga_numero_pagamento'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}