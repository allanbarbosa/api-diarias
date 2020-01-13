<?php

declare(strict_type=1);

namespace Diarias\Classe;

use Diarias\Classe\Models\ClasseModel;
use Diarias\Classe\Repositorios\ClasseRepositorio;


class ClasseServico
{
    protected $repositorio;

    public function __construct(ClasseRepositorio $classeRepositorio)
    {
        $this->repositorio = $classeRepositorio;
    }

    public function find(int $id)
    {
        $classe = $this->repositorio->find($id);

        return $this->tratarOutput($classe);
    }

    public function all(array $input)
    {
        $classes = $this->repositorio->getwhere($input);
        $dados = [
            'itens' => [],
            'total'=> 0
        ];

        foreach ($classes as $classe) {
            $dados['itens'][] = $this->tratarOutput($classe);
        }

        if (isset($input['count'])) {
            $dados['total'] = $classes->total();
        }else {
            $dados['total'] = count($classes);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $classe = $this->repositorio->save($dados);

        return $this->tratarOutput($classe);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['update_by'] = $input['usuario'];

        $classe = $this->repositorio->update($dados, $id);
        
        return $this->tratarOutput($classe);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'clas_id' => array_key_exists('id', $input) ? $input['id'] : null,
            'clas_nome' => array_key_exists('nome', $input) ? $input['nome'] : null
        ];
    }

    protected function tratarOutput(ClasseModel $model)
    {
        return [
            'id' => $model->clas_id,
            'nome' =>$model->clas_nome,
        ];
    }

}





