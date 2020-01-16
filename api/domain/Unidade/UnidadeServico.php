<?php
declare(strict_types=1);

namespace Diarias\Unidade;

use Diarias\Unidade\Models\UnidadeModel;
use Diarias\Unidade\Repositorios\UnidadeRepositorio;

class UnidadeServico
{
    protected $repositorio;

    public function __construct(UnidadeRepositorio $unidadeRepositorio)
    {
        $this->repositorio = $unidadeRepositorio;
    }

    public function find(int $id)
    {
        $unidade = $this->repositorio->find($id);

        return $this->tratarOutput($unidade);
    }

    public function all(array $input)
    {
        $unidades = $this->repositorio->getWhere($input);

        $dados = [
            'itens' => [],
            'total' => 0,
        ];

        foreach ($unidades as $unidade)
        {
            $dados['itens'][] = $this->tratarOutput($unidade);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $unidades->total();
        }
        else
        {
            $dados['total'] = count($unidades);
        }

        return $dados;
        
    }

    public function save(array $input)
    {
        $dados = $this->tratarOutput($input);

        $unidade = $this->repositorio->save($dados);

        return $this->tratarOutput($unidade);
         
    }

    public function update(array $input, int $id)
    {
        $dados = $this->trataInput($input);

        $unidade = $this->repositorio->update($dados, $id);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'unid_id' => isset($input['id']) ? $input['id'] : null,
            'unid_nome' => isset($input['nome']) ? $input['nome'] : null,
            'unid_sigla' => isset($input['sigla']) ? $input['sigla'] : null
        ];
    }

    protected function tratarOutput(UnidadeModel $model)
    {
        return [
            'id' => $model->unid_id,
            'nome' => $model->unid_nome,
            'sigla'=> $model->unid_sigla
        ];
    }
}