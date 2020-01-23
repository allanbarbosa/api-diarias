<?php
declare(strict_types=1);

namespace Diarias\Feriado;

use Diarias\Feriado\Models\FeriadoModel;
use Diarias\Feriado\Repositorios\FeriadoRepositorio;

class FeriadoServico
{
    protected $repositorio;

    public function __construct(FeriadoRepositorio $feriadoRepositorio)
    {
        $this->repositorio = $feriadoRepositorio;
    }

    public function find(int $id)
    {
        $feriado = $this->repositorio->find($id);

        return $this->tratarOutput($feriado);
    }

    public function all(array $input)
    {
        $feriados = $this->repositorio->getWhere($input);
        $dados = [];

        foreach ($feriados as $feriado) {
            $dados[] = $this->tratarOutput($feriado);
        }
        
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $feriado = $this->repositorio->save($dados);

        return $this->tratarOutput($feriado);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $feriado = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($feriado);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'feri_dia' => $input['feriadoDia'],
            'feri_mes' => $input['feriadoMes'],
            'feri_nome' => $input['feriadoNome'],
        ];
    }

    protected function tratarOutput(FeriadoModel $feriadoModel)
    {
        return [
            'id' => $feriadoModel->feri_id,
            'feriadoDia' => $feriadoModel->feri_dia,
            'feriadoMes' => $feriadoModel->feri_mes,
            'feriadoNome' => $feriadoModel->feri_nome,
        ];
    }
}