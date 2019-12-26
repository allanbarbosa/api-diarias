<?php
declare(strict_types=1);

namespace Diarias\Gratificacao\Repositorios;

use Diarias\Gratificacao\Models\GratificacaoModel;
use Exception;

class GratificacaoRepositorio
{
    protected $model;

    protected $fields = [
        'grat_nome',
        'grat_slug',
        'grat_valor_diaria',
        'id_classe',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(GratificacaoModel $gratificacaoModel)
    {
        $this->model = $gratificacaoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('grat_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Gratificação não encontrado');
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
        $model = $this->model->orderBy('grat_nome', 'ASC');

        if (isset($input['grat_nome']))
        {
            $model = $model->where('grat_nome', 'ilike', '%'.$input['grat_nome'].'%');
        }

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }
}
