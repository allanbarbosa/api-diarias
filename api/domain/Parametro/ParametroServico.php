<?php
declare(strict_types=1);

namespace Diarias\Parametro;

use Diarias\Parametro\Repositorios\ParametroRepositorio;
use Diarias\Parametros\Models\ParametroModel;

class ParametroServico
{
    protected $repositorio;

    public function __construct(ParametroRepositorio $parametroRepositorio)
    {
        $this->repositorio = $parametroRepositorio;
    }

    public function find(int $id)
    {
        $parametro = $this->repositorio->find($id);

        return $this->tratarOutput($parametro);
    }

    public function all(array $input)
    {
        $parametros = $this->repositorio->getWhere($input);
        $dados = [];

        foreach ($parametros as $parametro) {
            $dados[] = $this->tratarOutput($parametro);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $parametro = $this->repositorio->save($dados);

        return $this->tratarOutput($parametro);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $parametro = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($parametro);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'para_max_diarias_mes' => $input['maxDiariasMes'],
            'para_max_diarias_ano' => $input['maxDiariasAno'],
            'para_max_diarias_consecutivas' => $input['maxDiariasConsecutivas'],
        ];
    }

    protected function tratarOutput(ParametroModel $parametroModel)
    {
        return [
            'id' => $parametroModel->para_id,
            'maxDiariasMes' => $parametroModel->para_max_diarias_mes,
            'maxDiariasAno' => $parametroModel->para_max_diarias_ano,
            'maxDiariasConsecutivas' => $parametroModel->para_max_diarias_consecutivas,
        ];
    }
}