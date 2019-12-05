<?php

declare (strict_types=1);

namespace Diarias\Organograma\Repositorio;

use Diarias\Organograma\Models\OrganogramaModel;
use Exception;

class OrganogramaRepositorio
{
    protected $model;

    protected $fields = [
        'orga_codigo',
        'orga_data_inicio',
        'orga_data_fim',
        'created_by',
        'updated_by'
    ]; 

public function __construct(OrganogramaModel $Organograma)
{
    $this->nodel = $Organograma;
}    

public function find(int $id)
{
    $model = $this->model->where('orga_id', '=', $id)->first();

    if (!$model) {
        throw new Exception('Organograma não encontrada.');
    }

    return $model;
}

public function all()
{
    return $this->model->all();
}

public function save (array $input)
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

public function getwhere(array $input)
{
    $model = $this->model->orderby('orga_codigo', 'ASC');

    if (isset($input['orga_codigo'])){
       $model = $model->where('orga_codigo', 'ilike', '%'.$input['orga_codigo'].'%'); 
    }

    if (isset($input['count'])){
        return $model->paginate($input['count']);
    }

    return $model->get();

}

}
