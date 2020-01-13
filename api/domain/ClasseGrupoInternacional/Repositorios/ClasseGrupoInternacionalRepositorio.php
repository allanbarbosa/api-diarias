<?php
declare(strict_type=1);

namespace Diarias\ClasseGrupoInternacional\Repositorios;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Exception;

class ClasseGrupoInternacionalRepositorio
{
    protected $model;

    protected $fields = [
        'clas_gru_internacional_valor',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        $this->model = $classeGrupoInternacionalModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('clas_gru_internacional_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Classe grupo internacional não encontrada.');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->model->{$field} = $input[$field];
            }
        }

        $this->model->save();

        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field) {
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
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('clas_gru_internacional_valor', 'ASC');

        if (isset($input['clas_gru_internacional_valor'])) {
            $model = $model->where('clas_gru_internacional_valor', '%'.$input['clas_gru_internacional_valor'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}