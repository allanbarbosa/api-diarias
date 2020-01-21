<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Repositorios;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Exception;

class VinculoEmpregaticioRepositorio
{
    protected $model;

    protected $fields = [
        'vinc_emp_matricula',
        'vinc_emp_data_admissao',
        'vinc_emp_data_desligamento',
        'id_funcionario'
    ];

    public function __construct(VinculoEmpregaticioModel $vinculoEmpregaticioModel)
    {
        $this->model = $vinculoEmpregaticioModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('vinc_emp_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Vínculo empregatício não encontrado');
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
        $model = $this->model->orderBy('vinc_emp_matricula', 'ASC');

        if (isset($input['vinc_emp_matricula']))
        {
            $model = $model->where('vinc_emp_matricula', 'ilike', '%'.$input['vinc_emp_matricula'].'%');
        }

        return $model->get();
    }
}
