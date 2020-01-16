<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacional;

use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;
use Diarias\GrupoInternacional\Repositorios\GrupoInternacionalRepositorio;

class GrupoInternacionalServico
{
    protected $repositorio;

    public function __construct(GrupoInternacionalRepositorio $grupointernacionalRepositorio)
    {
        $this->repositorio = $grupointernacionalRepositorio;
    }

    public function find(int $id)
    {
        $grupoInternacional = $this->repositorio->find($id);

        return $this->tratarOutput($grupoInternacional);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        
        $grupoInternacional = $this->repositorio->save($dados->toArray());

        return $this->tratarOutput($grupoInternacional);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $grupoInternacional = $this->repositorio->update($dados->toArray(), $id);

        return $this->tratarOutput($grupoInternacional);
    }

    public function delete(int $id)
    {

        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return new GrupoInternacionalModel([
            'grup_int_id' => isset($input['id']) ? $input['id'] : null,
            'grup_int_codigo' => isset($input['codigo']) ? $input['codigo'] : null
        ]);
    }

    protected function tratarOutput(GrupoInternacionalModel $grupoInternacionalModel)
    {
        $output = [
            'id' => $grupoInternacionalModel->grup_int_id,
            'codigo' => $grupoInternacionalModel->grup_int_codigo,
            'grupoInternacionalPaises' => [],
            'classesXgruposInternacionais' => [],
        ];
        foreach ($grupoInternacionalModel->grupo_internacional_paises as $grupo_internacional_pais) {
            $output['grupoInternacionalPaises'][] = [
                'id' => $grupo_internacional_pais->grup_int_pais_id,
                'idPais' => $grupo_internacional_pais->id_pais,
                'pais' => [
                    'id' => $grupo_internacional_pais->pais->pais_id,
                    'nome' => $grupo_internacional_pais->pais->pais_nome
                ]
            ];
        }
        foreach ($grupoInternacionalModel->classes_x_grupos_internacionais as $classe_x_grupo_internacional) {
            $output['classesXgruposInternacionais'][] = [
                'id' => $classe_x_grupo_internacional->clas_gru_internacional_id,
                'valor' => $classe_x_grupo_internacional->clas_gru_internacional_valor,
                'idClasse' => $classe_x_grupo_internacional->id_classe,
                'classe' => [
                    'id' => $classe_x_grupo_internacional->classe->classe_id,
                    'nome' => $classe_x_grupo_internacional->classe->classe_nome
                ]
            ];
        }
        return $output;
    }
}