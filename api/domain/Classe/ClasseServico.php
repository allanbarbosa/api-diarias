<?php

declare(strict_type=1);

namespace Diarias\Classe;

use Diarias\Classe\Models\ClasseModel;
use Diarias\Classe\Repositorios\ClasseRepositorio;


class ClasseServico
{
    protected $classe;

    public function __construct(ClasseRepositorio $ClasseRepositorio)
    {
        $this->repositorio = $ClasseRepositorio;
    }

    public function find(int $id)
    {
        $classe = $this->repositorio->find($id);

        return $this->trataroutput($classe);
    }

    public function all(array $input)
    {
        $classe = $this->repositorio->getwhere($input);
        $dados = [
            'itens' => [],
            'total'=> 0
        ];

        foreach ($classe as $classe) {
            $dados['itens'][] = $this->tratarOutput($classe);
        }

        if (isset($input['count'])) {
            $dados['total'] = $classe->total();
        }else {
            $dados['total'] = count($classe);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $classe = $this->repositorio->save($dados);

        return $this->tratarOutput($classe);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $classe = $this->repositorio->update($dados, $id);
        
        return $this->tratarOutput($classe);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'clas_nome' => $input['nome'],
        ];
    }

    protected function tratarOutput(classeModel $classeModel)
    {
        return [
            'id' => $classeModel->clas_id,
            'clas_nome' =>$classeModel->clas_nome,
        ];
    }


    
}





