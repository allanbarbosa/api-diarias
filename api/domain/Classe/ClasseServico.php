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
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
            
            'clas_nome' => $input['nome']
        ];
    }

    protected function tratarOutput(ClasseModel $model)
    {
        $output = [
            'id' => $model->clas_id,
            'nome' =>$model->clas_nome,
            'gratificacoes' => [],
        ];
        foreach ($model->gratificacoes as $gratificacao) {
            $output['gratificacoes'][] = [
                'id' => $gratificacao->grat_id,
                'nome' => $gratificacao->grat_nome,
                'slug' => $gratificacao->grat_slug,
                'valor' => $gratificacao->grat_valor_diaria
            ];
        }
        return $output;
    }

}





