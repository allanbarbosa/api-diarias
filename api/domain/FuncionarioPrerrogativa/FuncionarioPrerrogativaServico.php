<?php
declare(strict_types=1);

namespace Diarias\FuncionarioPrerrogativa;

use Diarias\FuncionarioPrerrogativa\Models\FuncionarioPrerrogativaModel;
use Diarias\FuncionarioPrerrogativa\Repositorios\FuncionarioPrerrogativaRepositorio;

class FuncionarioPrerrogativaServico
{
    protected $repositorio;

    public function __construct(FuncionarioPrerrogativaRepositorio $funcionarioPrerrogativaRepositorio)
    {
        $this->repositorio = $funcionarioPrerrogativaRepositorio;
    }

    public function find(int $id)
    {
        $funcionarioPrerrogativa = $this->repositorio->find($id);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function all(array $input)
    {
        $funcionarioPrerrogativas = $this->repositorio->getWhere($input);
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($funcionarioPrerrogativas as $funcionarioPrerrogativa) {
            $dados['itens'][] = $this->tratarOutput($funcionarioPrerrogativa);
        }

        if (isset($input['count'])) {
            $dados['total'] = $funcionarioPrerrogativas->total();
        } else {
            $dados['total'] = count($funcionarioPrerrogativas);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $funcionarioPrerrogativa = $this->repositorio->save($dados);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $funcionarioPrerrogativa = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($funcionarioPrerrogativa);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'func_pre_data_inicio' => $input['data_inicio'],
            'func_pre_data_fim' => $input['data_fim'],
        ];
    }

    protected function tratarOutput(FuncionarioPrerrogativaModel $funcionarioPrerrogativaModel)
    {
        return [
            'id' => $funcionarioPrerrogativaModel->func_pre_id,
            'data_inicio' => $funcionarioPrerrogativaModel->func_pre_data_inicio,
            'data_fim' => $funcionarioPrerrogativaModel->func_pre_data_fim,
        ];
    }
}
