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

    ];

    public function __construct(UnidadeModel $unidadeModel)
    {
        $this->model = $unidadeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('unid_id', '=', $id)->first();

        if ($model)
        {
            throw new Exception('Unidade não encontrada.');
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
                $this->model[$field] = $input[$field];
            }
            
            $this->model->save();

            return $this->model;
        }
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

        return $model->delete($id);
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('unid_nome', 'unid_sigla', 'ASC');

        if (isset($input['unid_nome']))
        {
            $model = $model->where('unid_nome', 'ilike', '%'.$input['unid_nome'].'%');
        }

        if (isset($input['unid_sigla']))
        {
            $model = $model->where('unid_sigla', 'ilike', '%'.$input['unid_sigla'].'%');
        }

        if (isset($input['count']))
        {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}