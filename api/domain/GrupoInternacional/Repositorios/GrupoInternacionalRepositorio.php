<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacional\Repositorios;

use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;
use Exception;

class GrupoInternacionalRepositorio
{
    protected $model;

    protected $fields = [
        'grup_int_codigo',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(GrupoInternacionalModel $grupointernacionalModel)
    {
        $this->model = $grupointernacionalModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('grup_int_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Grupo Internacional não encontrada.');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        return \DB::transaction(function () use ($input) {
            foreach ($this->fields as $field) {
                if (isset($input[$field])) {
                    $this->model->{$field} = $input[$field];
                }
            }

            $this->model->save();
            
            if (isset($input['grupo_internacional_paises'])) {
                $this->model->pais()->sync($input['grupo_internacional_paises']);
            }
            
            return $this->model;
        });
    }

    public function update(array $input, int $id)
    {
        return \DB::transaction(function () use ($input, $id) {
            $model = $this->find($id);

            foreach ($this->fields as $field) {
                if (isset($input[$field])) {
                    $model->{$field} = $input[$field];
                }
            }

            $model->save();
            
            if (isset($input['grupo_internacional_paises'])) {
                $model->pais()->sync($input['grupo_internacional_paises']);
            }
            
            return $model;
        });
        
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
        $model = $this->model->orderBy('grup_int_codigo', 'ASC');

        if (isset($input['grup_int_codigo'])) {
            $model = $model->where('grup_int_codigo', 'ilike', '%'.$input['grup_int_codigo'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}
