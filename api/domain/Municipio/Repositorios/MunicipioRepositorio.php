<?php
declare(strict_types=1);

namespace Diarias\Municipio\Repositorios;

use Diarias\Municipio\Models\MunicipioModel;
use Exception;

class MunicipioRepositorio
{
    protected $model;

    protected $fields = [
        'muni_nome',
        'muni_codigo_ibge',
        'muni_slug',
        'muni_porcentagem_diaria',
        'id_estado',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(MunicipioModel $municipioModel)
    {
        $this->model = $municipioModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('muni_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Município não encontrado');
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
        $model = $this->model->orderBy('muni_nome', 'ASC');

        if (isset($input['muni_nome']))
        {
            $model = $model->where('muni_nome', 'ilike', '%'.$input['muni_nome'].'%');
        }

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }
}
