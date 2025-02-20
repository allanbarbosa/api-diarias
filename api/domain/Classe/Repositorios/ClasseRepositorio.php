<?php

declare(strict_types=1);

namespace Diarias\Classe\Repositorios;

use Diarias\Classe\Models\ClasseModel;
use Exception;

class ClasseRepositorio

{
    protected $model;

    protected $fields = [
        'clas_nome',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(ClasseModel $classeModel)
    {
        $this->model = $classeModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('clas_id', '=', $id)->first();
        
        if (!$model)
        {
            throw new Exception ('Classe não encontrada.');
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

        foreach($this->fields as $field) {
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

    public function getwhere(array $input)
    {   
        $model = $this->model->orderBy('clas_nome', 'ASC');
        
        if (isset($input['clas_nome'])) {
            $model = $model->where('clas_nome', 'ilike', '%'.$input['clas_nome'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginete($input['count']);

        }   

        return $model->get();    
    }


}
