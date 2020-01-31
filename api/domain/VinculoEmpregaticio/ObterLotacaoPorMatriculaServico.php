<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio;

use Diarias\Lotacao\Models\LotacaoModel;
use Diarias\Lotacao\Repositorios\LotacaoRepositorio;
use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
use Diarias\VinculoEmpregaticio\Repositorios\VinculoEmpregaticioRepositorio;

class ObterLotacaoPorMatriculaServico
{
    protected $repositorio;
    protected $repositorioLotacao;

    public function __construct(VinculoEmpregaticioRepositorio $vinculoEmpregaticioRepositorio, LotacaoRepositorio $lotacaoRepositorio)
    {
        $this->repositorio = $vinculoEmpregaticioRepositorio;
        $this->repositorioLotacao = $lotacaoRepositorio;
    }

    public function find($matricula)
    {
        $vinculoEmpregaticio = $this->repositorio->find($matricula);

        return $this->tratarOutput($vinculoEmpregaticio);
    }

    protected function tratarOutput(VinculoEmpregaticioModel $model, LotacaoModel $lotacaoModel)
    {
        dd($lotacaoModel);
        $output = [
            
            'matricula' => $model->vinc_emp_matricula,
            'lotacao' => [],
            'cargo' => [
                'gratificacao' => [],
                'VinculoEmpregaticio' => [],
            ],
            'funcionario' => []
        ];

        // if ('matricula' == $model->vinc_emp_matricula && $lotacaoModel->lota_data_fim == null) {
        //    foreach ($variable as $key => $value) {
        //        # code...
        //    }
        // }
    }
}
