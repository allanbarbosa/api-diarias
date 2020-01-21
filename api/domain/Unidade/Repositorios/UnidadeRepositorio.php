<?php
declare(strict_types=1);

namespace Diarias\Unidade\Repositorios;

use Diarias\Unidade\Models\UnidadeModel;
use Exception;

class UnidadeRepositorio
{
    protected $model;

    protected $fields = [
        'unid_nome',
        'unid_sigla',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(UnidadeModel $unidadeModel)
    {
        $this->model = $unidadeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('unid_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Unidade não encontrado');
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

        $model->save();

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('unid_nome', 'ASC');

        if (isset($input['unid_nome']))
        {
            $model = $model->where('unid_nome', 'ilike', '%'.$input['unid_nome'].'%');
        }

        return $model->get();
    }
}
