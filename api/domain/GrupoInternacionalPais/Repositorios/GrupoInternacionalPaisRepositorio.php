<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacionalPais\Repositorios;

use Diarias\GrupoInternacionalPais\Models\GrupoInternacionalPaisModel;
use Exception;

class GrupoInternacionalPaisRepositorio
{
    protected $model;

    protected $fields = [
        'id_pais',
        'id_grupo_internacional'
    ];

    public function __construct(GrupoInternacionalPaisModel $grupoInternacionalPaisModel)
    {
        $this->model = $grupoInternacionalPaisModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('grup_int_pais_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Grupo Internacional País não encontrado');
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
        if (isset($input['idGrupoInternacional']))
        {
            $model = $model->where('id_grupo_internacional', '=', $input['idGrupoInternacional']);
        }
        if (isset($input['idPais']))
        {
            $model = $model->where('id_pais', '=', $input['idPais']);
        }

        
        return $model->get();
    }
}
