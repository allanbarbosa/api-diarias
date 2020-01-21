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
        $dados['created_by'] = $input['usuario'];

        $unidade = $this->repositorio->save($dados);

        return $this->tratarOutput($unidade);
         
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $unidade = $this->repositorio->update($dados, $id);
        
        return $this->tratarOutput($unidade);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            
            'unid_nome' => $input['nome'],
            'unid_sigla' => $input['sigla']
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
