<?php
declare(strict_types=1);

namespace Diarias\Escolaridade\Repositorios;

use Diarias\Escolaridade\Models\EscolaridadeModel;
use Exception;


class EscolaridadeRepositorio
{
    protected $model;

    protected $fields = [
        'esco_nome',
        'esco_slug',
    ];

    protected function __construct(EscolaridadeModel $escolaridadeModel)
    {
        $this->model = $escolaridadeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('esco_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Escolaridade não encontrada.');
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
                $this->model{$field} = $input[$field];
            }
        }
        $this->model->save();
        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->model->find($id);

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
        $model = $this->model->orderBy('esco_nome', 'ASC');

        if (Isset($input['esco_nome']))
        {
            $model = $model->where('esco_nome', 'ilike', '%'.$input['esco_nome'].'%');
        }

        if (isset($input['count']))
        {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}