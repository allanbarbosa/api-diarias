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
        $classeGrupoInternacionais = $this->repositorio->getWhere($input);
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($classeGrupoInternacionais as $classeGrupoInternacional) {
            $dados['itens'][] = $this->tratarOutput($classeGrupoInternacional);
        }

        if (isset($input['count'])) {
            $dados['total'] = $classeGrupoInternacionais->total();
        } else {
            $dados['total'] = count($classeGrupoInternacionais);
        }

        return $dados;
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

        $classeGrupoInternacional = $this->repositorio->update($dados, $id);

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
            'id_classe' => $input['classe'],
            'id_grupo_internacional' => $input['grupo_internacional'],
        ];
    }

    protected function tratarOutput(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        return [
            'id' => $classeGrupoInternacionalModel->clas_gru_internacional_id,
            'valor' => $classeGrupoInternacionalModel->clas_gru_internacional_valor,
            'classe' => $classeGrupoInternacionalModel->id_classe,
            'grupo_internacional' => $classeGrupoInternacionalModel->id_grupo_internacional,
        ];
    }
}
