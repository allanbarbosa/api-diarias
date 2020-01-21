<?php
declare(strict_types=1);

namespace Diarias\UnidadeOrganograma;

use Diarias\UnidadeOrganograma\Models\UnidadeOrganogramaModel;
use Diarias\UnidadeOrganograma\Repositorios\UnidadeOrganogramaRepositorio;

class UnidadeServico
{
    protected $repositorio;

    public function __construct(UnidadeOrganogramaRepositorio $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function find(int $id)
    {
        $unidade = $this->repositorio->find($id);

        return $this->tratarOutput($unidade);
    }

    public function all(array $input)
    {
        $unidades = $this->repositorio->getWhere($input);

        $dados = [];

        foreach ($unidades as $unidade)
        {
            $dados[] = $this->tratarOutput($unidade);
        }

        return $dados;
        
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $unidade = $this->repositorio->save($dados);

        return $this->tratarOutput($unidade);
         
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $unidade = $this->repositorio->update($dados, $id);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        
        return [
            
            'id_unidade_pai' => isset($input['idUnidadePai']) ? $input['idUnidadePai'] : null,
            'id_unidade' => $input['idUnidade'],
            'id_organograma' => $input['idOrganograma'],
            'id_papel_fluxograma' => $input['idPapelFluxograma']
        ];
    }

    protected function tratarOutput(UnidadeOrganogramaModel $model)
    {
        return [
            'id' => $model->unid_org_id,
            'idUnidadePai' => $model->id_unidade_pai,
            'idUnidade' => $model->id_unidade,
            'idOrganograma' => $model->id_organograma,
            'idPapelFluxograma' => $model->id_papel_fluxograma
        ];
    }
}