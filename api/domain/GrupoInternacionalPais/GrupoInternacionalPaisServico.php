<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacionalPais;

use Diarias\GrupoInternacionalPais\Models\GrupoInternacionalPaisModel;
use Diarias\GrupoInternacionalPais\Repositorios\GrupoInternacionalPaisRepositorio;

class GrupoInternacionalPaisServico
{
    protected $repositorio;

    public function __construct(GrupoInternacionalPaisRepositorio $grupoInternacionalPaisRepositorio)
    {
        $this->repositorio = $grupoInternacionalPaisRepositorio;
    }

    public function find(int $id)
    {
        $grupoInternacionalPais = $this->repositorio->find($id);

        return $this->tratarOutput($grupoInternacionalPais);
    }

    public function all(array $input, $paginage = false)
    {
        $grupoInternacionalPaises = array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
        if (!$paginage) {
            return $grupoInternacionalPaises;
        }
        $dados = [];

        foreach ($grupoInternacionalPaises as $grupoInternacionalPais)
        {
            $dados[] = $grupoInternacionalPaises;
        }

        return $dados;
    }
    
    public function save(array $input)
    {
        $model = $this->tratarInput($input);

        $grupoInternacionalPais = $this->repositorio->save($model->toArray());

        return $this->tratarOutput($grupoInternacionalPais);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $grupoInternacionalPais = $this->repositorio->update($dados->toArray(), $id);

        return $this->tratarOutput($grupoInternacionalPais);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            
            'id_pais' => $input['idPais'],
            'id_grupo_internacional' => $input['idGrupoInternacional']
        ];
    }

  protected function tratarOutput(GrupoInternacionalPaisModel $model)
  {
    return [
        'id' => $model->grup_int_pais_id,
        'idPais' => $model->id_pais,
        'pais' =>
        [
            'id' => $model->pais->pais_id,
            'nome' => $model->pais->pais_nome
        ],
        'idGrupoInternacional' => $model->id_grupo_internacional,
        'grupoInternacional' =>
        [
            'id' => $model->grupo_internacional->grup_int_id,
            'codigo' => $model->grupo_internacional->grup_int_codigo
        ]
    ];
  }
}