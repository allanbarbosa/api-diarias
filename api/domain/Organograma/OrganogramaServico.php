<?php

declare (strict_types = 1);

namespace Diarias\Organograma;

use Diarias\Organograma\Models\OrganogramaModel;
use Diarias\Organograma\Repositorios\OrganogramaRepositorio;

class OrganogramaServico
{

    protected $repositorio;

    public function __construct(OrganogramaRepositorio $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function find(int $id)
    {
        $organograma = $this->repositorio->find($id);

        return $this->tratarOutput($organograma);

    }

    public function all(array $input, $paginage = false)
    {
        $organogramas = array_map(array($this, 'tratarOutput'), $this->repositorio->getwhere($input)->all());
        if (!$paginage) {
            return $organogramas;
        }

        $dados = [
            'itens' => [],
            'Total' => 0,
        ];

        foreach ($organogramas as $organograma) {
            $dados['itens'][] = $this->tratarOutput($organograma);
        }

        if (isset($input['count'])) {

            $dados['total'] = $organograma->total();
        } else {
            $dados['total'] = count($organogramas);
        }

        return $dados;

    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados = [$updated_by] = $input['usuario'];

        $organograma = $this->repositorio->save($dados);

        return $this->tratarOutput($organograma);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $organograma = $this->repositorio->save($dados, $id);

        return $this->tratarOutput($organograma);

    }
    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    public function obterOrganogramaAtual()
    {
        $organograma = $this->repositorio->obterOrganogramaAtual();
        return $this->tratarOutput($organograma);
    }
    
    public function obterSugestaoCodigo()
    {
        $codAtual = $this->repositorio->obterOrganogramaAtual()->orga_codigo;
        $parts = explode('.', $codAtual);
        if (count($parts) != 2 || !is_numeric($parts[0]) || !is_numeric($parts[1])) {
            return '';
        }
        if ($parts[0] == date('Y')) {
            $novaVersao = intval($parts[1]) + 1;
            return $parts[0].'.'.$novaVersao;
        } else {
            return date('Y').'.1';
        }
        
    }

    protected function tratarInput(array $input)
    {
        return [
            'orga_id' => array_key_exists('id', $input) ? $input['id'] : null,
            'orga_codigo' => array_key_exists('codigo', $input) ? $input['codigo'] : null,
            'orga_data_inicio' => array_key_exists('dataInicio', $input) ? $input['dataInicio'] : null,
            'orga_data_fim' => array_key_exists('dataFim', $input) ? $input['dataFim'] : null,
        ];
    }
    
    protected function tratarOutput(OrganogramaModel $model)
    {
        $output = [
            'id' => $model->orga_id,
            'codigo' => $model->orga_codigo,
            'dataInicio' => $model->orga_data_inicio,
            'dataFim' => $model->orga_data_fim,
            'unidadeOrganogramas' => []
        ];
        foreach ($model->unidade_organogramas as $unidade_organograma) {
            $output['unidadeOrganogramas'][] = [
                'id' => $unidade_organograma->unid_org_id,
                'idUnidadePai' => $unidade_organograma->id_unidade_pai,
                'unidadePai' => $unidade_organograma->unidade_pai != null ? [
                    'id' => $unidade_organograma->unidade_pai->unid_id,
                    'nome' => $unidade_organograma->unidade_pai->unid_nome,
                    'sigla' => $unidade_organograma->unidade_pai->unid_sigla
                ] : null,
                'idUnidade' => $unidade_organograma->id_unidade,
                'unidade' => [
                    'id' => $unidade_organograma->unidade->unid_id,
                    'nome' => $unidade_organograma->unidade->unid_nome,
                    'sigla' => $unidade_organograma->unidade->unid_sigla
                ],
                'idOrganograma' => $unidade_organograma->id_organograma,
                'idPapelFluxograma' => $unidade_organograma->id_papel_fluxograma,
                'papelFluxograma' => [
                    'id' => $unidade_organograma->papel_fluxograma->pape_flu_id,
                    'slug' => $unidade_organograma->papel_fluxograma->pape_flu_slug,
                    'descricao' => $unidade_organograma->papel_fluxograma->pape_flu_descricao
                ]
            ];
        }
        return $output;
    }
}
