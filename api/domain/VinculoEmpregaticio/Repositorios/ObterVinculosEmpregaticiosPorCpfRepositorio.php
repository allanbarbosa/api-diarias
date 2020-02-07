<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Repositorios;

use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;

class ObterVinculosEmpregaticiosPorCpfRepositorio
{
    protected $model;

    protected $fields = [
        'vinc_emp_matricula',
        'vinc_emp_data_admissao',
        'vinc_emp_data_desligamento',
        'id_funcionario'
    ];

    public function __construct(VinculoEmpregaticioModel $model)
    {
        $this->model = $model;
    }
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('vinc_emp_data_admissao', 'DESC')
            ->join('funcionario', 'vinculo_empregaticio.id_funcionario', '=', 'funcionario.func_id')
            ->where('func_cpf', '=', $input['func_cpf']);
        
        return $model->get();
    }
}