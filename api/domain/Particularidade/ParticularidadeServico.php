<?php

declare(strict_types=1);

namespace Diarias\Particularidade;

use Diarias\Particularidade\Models\ParticularidadeModel;
use Diarias\Particularidade\Repositorios\ParticularidadeRepositorio;
use Illuminate\Support\Str;

class ParticularidadeServico
{
    protected $repositorio;

    public function __construct(ParticularidadeRepositorio $particularidadeRepositorio)
    {
        $this->repositorio = $particularidadeRepositorio;
    }

    public function find(int $id)
    {
        $particularidade = $this->repositorio->find($id);

        return $this->tratarOutput($particularidade);
    }

    public function all(array $input)
    {
        $particularidades = $this->repositorio->getWhere($input);
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($particularidades as $particularidade) {
            $dados['itens'][] = $this->tratarOutput($particularidade);
        }

        if (isset($input['count'])) {
            $dados['total'] = $particularidades->total();
        } else {
            $dados['total'] = count($particularidades);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $particularidade = $this->repositorio->save($dados);

        return $this->tratarOutput($particularidade);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $particularidade = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($particularidade);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'part_descricao' => $input['descricao'],
            'part_slug' => Str::slug($input['slug']),
        ];
    }

    protected function tratarOutput(ParticularidadeModel $particularidadeModel)
    {
        return [
            'id' => $particularidadeModel->part_id,
            'descricao' => $particularidadeModel->part_descricao,
            'slug' => $particularidadeModel->part_slug,
        ];
    }
}
