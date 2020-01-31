<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Repositorios;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Exception;

class ObterLotacaoPorMatriculaRepositorio
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

    public function find($matricula)
    {
        // dd($matricula);
        $model = $this->model->where('vinc_emp_matricula', '=', $matricula)->first();

        if (!$model)
        {
            throw new Exception('Lotacao por matricula não encontrada');
        }

        return $model;
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