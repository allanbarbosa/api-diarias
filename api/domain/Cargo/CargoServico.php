<?php
declare(strict_types=1);

namespace Diarias\Cargo;

use Diarias\Cargo\Models\CargoModel;
use Diarias\Cargo\Repositorios\CargoRepositorio;
use Illuminate\Support\Str;

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
            'carg_id' => isset($input['id']) ? $input['id'] : null,
            'carg_nome' => isset($input['nome']) ? $input['nome'] : null,
            'carg_slug' => isset($input['slug']) ? $input['slug'] : Str::slug($input['nome']),
            'id_gratificacao' => isset($input['idGratificacao']) ? $input['idGratificacao'] : null
        ];
    }

    protected function tratarOutput(CargoModel $model)
    {
        return [
            'id' => $model->carg_id,
            'nome' => $model->carg_nome,
            'slug' => $model->carg_slug,
            'idGratificacao' => $model->id_gratificacao,
            'gratificacao' =>
            [
                'id' => $model->gratificacao->grat_id,
                'nome' => $model->gratificacao->grat_nome,
            ]
        ];
    }
}