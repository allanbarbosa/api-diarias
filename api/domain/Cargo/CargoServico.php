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
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
            'id_gratificacao' => $input['idGratificacao'],
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