<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Repositorios;


use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Exception;

class ObterLotacaoAtualPorIdFuncionarioRepositorio
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

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('id_funcionario', 'ASC')->whereNull('vinc_emp_data_desligamento');

        if (isset($input['id_funcionario']))
        {
            $model = $model->where('id_funcionario', '=', $input['id_funcionario']);
        }

        return $model->get();
    }
}