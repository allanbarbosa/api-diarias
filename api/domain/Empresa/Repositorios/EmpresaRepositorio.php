<?php
declare(strict_types=1);

namespace Diarias\Empresa\Repositorios;

use Diarias\Empresa\Models\EmpresaModel;
use Exception;

class EmpresaRepositorio
{
    protected $model;

    protected $fields = [
        'empr_nome',
        'empr_sigla',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(EmpresaModel $empresaModel)
    {
        $this->model = $empresaModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('empr_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Empresa não encontrada');
        }
        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field)
        {
            if (isset($input[$field])) 
            {
                $this->model->{$field} = $input[$field];
            }
        }
        $this->model->save();

        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $model->{$field} = $input[$field];
            }
        }

        $model->save();

        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->find($id);

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('empr_nome', 'ASC');

        if (isset($input['empr_nome']))
        {
            $model = $model->where('empr_nome', 'ilike', '%'.$input['empr_nome'].'%');
        }

        if (isset($input['count']))
        {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }


}