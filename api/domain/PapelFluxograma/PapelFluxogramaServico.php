<?php
declare(strict_types=1);

namespace Diarias\PapelFluxograma;

use Diarias\PapelFluxograma\Repositorios\PapelFluxogramaRepositorio;
use Illuminate\Support\Str;
use Diarias\PapelFluxograma\Models\PapelFluxogramaModel;

class PapelFluxogramaServico
{
    protected $repositorio;

    public function __construct(PapelFluxogramaRepositorio $papelfluxogramaRepositorio)
    {
        $this->repositorio = $papelfluxogramaRepositorio;
    }

    public function find(int $id)
    {
        $papelfluxogramaRepositorio = $this->repositorio->find($id);

        return $this->tratarOutput($papelfluxogramaRepositorio);
    }

    public function all(array $input)
    {
        $papelfluxogramas = $this->repositorio->getWhere($input);

        $dados = [
            'itens' => [],
            'total' =>0
        ];

    foreach ($papelfluxogramas as $papelfluxograma) {
        $dados['itens'][] = $this->tratarOutput($papelfluxograma);
    }    

    if (isset($input['count'])) {
        $dados['total'] = $papelfluxograma->total();
    }else {
        $dados['total'] = count($papelfluxograma);
    }

    return $dados;

    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $papelfluxograma = $this->repositorio->save($dados);

        return $this->tratarOutput($papelfluxograma);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $papelfluxograma = $this->repositorio->updadte($dados, $id);

        return $this->tratarOutput($papelfluxograma);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [ 
            'pape_flu_descricao' => $input['descricao'],
            'pape_flu_slug' => Str::slug($input['descricao']),
        ];
    }

    protected function tratarOutput(PapelFluxogramaModel $papelfluxogramaModel)
    {
        return [
            'id' => $papelfluxogramaModel->papel_flu_id,
            'descricao' => $papelfluxogramaModel->pape_flu_descricao,
            'pape_flu_slug' => $papelfluxogramaModel->pape_flug_slug,
        ];
    }

}