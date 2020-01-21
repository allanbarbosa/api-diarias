<?php
declare(strict_types=1);

namespace Diarias\ClasseGrupoInternacional;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Diarias\ClasseGrupoInternacional\Repositorios\ClasseGrupoInternacionalRepositorio;


class ClasseGrupoInternacionalServico
{
    protected $repositorio;

    public function __construct(ClasseGrupoInternacionalRepositorio $classeGrupoInternacionalRepositorio)
    {
        $this->repositorio = $classeGrupoInternacionalRepositorio;
    }

    public function find(int $id)
    {
        $classeGrupoInternacional = $this->repositorio->find($id);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $classeGrupoInternacional = $this->repositorio->save($dados);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $classeGrupoInternacional = $this->repositorio->update($dados->toArray(), $id);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            
            'clas_gru_internacional_valor' => $input['valor'],
            'id_classe' => $input['idClasse'],
            'classe' => $input['classe'],
            'id_grupo_internacional' => $input['idGrupoInternacional'],
            'grupo_internacional' => $input['grupoInternacional']
        ];
    }

    protected function tratarOutput(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        return [
            'id' => $classeGrupoInternacionalModel->clas_gru_internacional_id,
            'valor' => $classeGrupoInternacionalModel->clas_gru_internacional_valor,
            'idClasse' => $classeGrupoInternacionalModel->id_classe,
            'classe' =>
            [
                'id' => $classeGrupoInternacionalModel->classe->clas_id,
                'nome' => $classeGrupoInternacionalModel->classe->clas_nome,
            ],
            'idGrupoInternacional' => $classeGrupoInternacionalModel->id_grupo_internacional,
            'grupoInternacional' =>
            [
                'id' => $classeGrupoInternacionalModel->grupo_internacional->grup_int_id,
                'codigo' => $classeGrupoInternacionalModel->grupo_internacional->grup_int_codigo
            ]
        ];
    }
}
