<?php
declare(strict_types=1);

namespace Diarias\UnidadeOrganograma\Repositorios;

use Diarias\UnidadeOrganograma\Models\UnidadeOrganogramaModel;
use Exception;

class UnidadeOrganogramaRepositorio
{
    protected $model;

    protected $fields = [
        'id_unidade_pai',
        'id_unidade',
        'id_organograma',
        'id_papel_fluxograma'
    ];

    public function __construct(UnidadeOrganogramaModel $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        $model = $this->model->where($model->primaryKey, '=', $id)->first();

        if (!$model)
        {
            throw new Exception('UnidadeOrganograma não encontrada');
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

    public function getWhere(array $input, $sortColumn = null, $sortDirection = 'ASC')
    {
        $sortColumn = isset($sortColumn) ? $sortColumn : 'unid_org_id';
        $model = $this->model->orderBy($sortColumn, $sortDirection);

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }
}
