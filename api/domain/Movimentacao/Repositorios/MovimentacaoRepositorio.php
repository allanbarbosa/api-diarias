<?php
declare(strict_types=1);

namespace Diarias\Movimentacao\Repositorios;

use Diarias\Movimentacao\Models\MovimentacaoModel;
use Exception;

class MovimentacaoRepositorio
{
    protected $model;

    protected $fields = [
        'movi_nome',
        'movi_slug',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(MovimentacaoModel $movimentacaoModel)
    {
        $this->model = $movimentacaoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('movi_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Movimentação não encontrada.');
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

    public function delete(int $id, int $usuario)
    {
        $model = $this->find($id);

        $model->deleted_by = $usuario;
        $model->save();

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('movi_nome', 'ASC');

        if (isset($input['movi_nome']))
        {
            $model = $model->where('movi_nome', 'ilike', '%'.$input['movi_nome'].'%');
        }

        return $model->get();
    }

}