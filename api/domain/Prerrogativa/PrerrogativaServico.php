<?php
declare(strict_types=1);

namespace Diarias\Prerrogativa;

use Diarias\Prerrogativa\Models\PrerrogativaModel;
use Diarias\Prerrogativa\Repositorios\PrerrogativaRepositorio;
use Illuminate\Support\Str;

class PrerrogativaServico
{
    protected $repositorio;

    public function __construct(PrerrogativaRepositorio $prerrogativaRepositorio)
    {
        $this->repositorio = $prerrogativaRepositorio;
    }

    public function find(int $id)
    {
        $prerrogativa = $this->repositorio->find($id);

        return $this->tratarOutput($prerrogativa);
    }

    public function all(array $input)
    {
        $prerrogativas = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($prerrogativas as $prerrogativa) {
            $dados['itens'][] = $this->tratarOutput($prerrogativa);
        }

        if (isset($input['count'])) {
            $dados['total'] = $prerrogativas->total();
        } else {
            $dados['total'] = count($prerrogativas);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $prerrogativa = $this->repositorio->save($dados);

        return $this->tratarOutput($prerrogativa);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $prerrogativa = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($prerrogativa);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'prer_descricao' => $input['descricao'],
            'prer_slug' => Str::slug($input['descricao']),
        ];
    }

    protected function tratarOutput(PrerrogativaModel $prerrogativaModel)
    {
        return [
            'id' => $prerrogativaModel->prer_id,
            'descricao' => $prerrogativaModel->prer_descricao,
            'slug' => $prerrogativaModel->prer_slug,
        ];
    }
}
