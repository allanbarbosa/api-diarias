<?php
declare(strict_types=1);

namespace Diarias\Cargo;

use Diarias\Cargo\Models\CargoModel;
use Diarias\Cargo\Repositorios\CargoRepositorio;

class CargoServico
{
    protected $repositorio;

    public function __construct(CargoRepositorio $cargoRepositorio)
    {
        $this->repositorio = $cargoRepositorio;
    }

    public function find(int $id)
    {
        $cargo = $this->repositorio->find($id);

        return $this->tratarOutput($cargo);
    }

    public function all(array $input)
    {
        $cargos = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'todos' => 0,
        ];

        foreach ($cargos as $cargo)
        {
            $dados['itens'][] = $this->tratarOutput($cargo);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $cargos->total();
        } 
        else
        {
            $dados['total'] = count($cargos);
        }
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $cargo = $this->repositorio->save($dados);

        return $this->tratarOutput($cargo);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $cargo = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($cargo);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'carg_nome' => $input['nome'],
            'carg_slug' => Str::slug($input['nome']),
            'id_gratificacao' => $input['gratificacao']
        ];
    }

    protected function tratarOutput(CargoModel $cargoModel)
    {
        return [
            'id' => $cargoModel->carg_id,
            'nome' => $cargoModel->carg_nome,
            'slug' => $cargoModel->carg_slug,
            'gratificacao' =>
            [
                'id' => $cargoModel->id_gratificacao,
                'nome' => $cargoModel->gratificacao->grat_nome,
            ]
        ];
    }
}