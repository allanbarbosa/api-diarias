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
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($feriados as $feriado) {
            $dados['itens'][] = $this->tratarOutput($feriado);
        }

        if (isset($input['count'])) {
            $dados['total'] = $feriados->total();
        } else {
            $dados['total'] = count($feriados);
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
            'feri_dia' => $input['feriado_dia'],
            'feri_mes' => $input['feriado_mes'],
            'feri_nome' => $input['feriado_nome'],
        ];
    }

    protected function tratarOutput(FeriadoModel $feriadoModel)
    {
        return [
            'id' => $feriadoModel->feri_id,
            'feriado_dia' => $feriadoModel->feri_dia,
            'feriado_mes' => $feriadoModel->feri_mes,
            'feriado_nome' => $feriadoModel->feri_nome,
        ];
    }
}