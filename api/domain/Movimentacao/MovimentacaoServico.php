<?php
declare(strict_types=1);

namespace Diarias\Movimentacao;

use Diarias\Movimentacao\Models\MovimentacaoModel;
use Diarias\Movimentacao\Repositorios\MovimentacaoRepositorio;
use Illuminate\Support\Str;

class MovimentacaoServico
{
    protected $repositorio;

    public function __construct(MovimentacaoRepositorio $movimentacaoRepositorio)
    {
        $this->repositorio = $movimentacaoRepositorio;
    }

    public function find(int $id)
    {
        $movimentacao = $this->repositorio->find($id);

        return $this->tratarOutput($movimentacao);
    }

    public function all(array $input)
    {
        $movimentacoes = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($movimentacoes as $movimentacao) {
            $dados[] = $this->tratarOutput($movimentacao);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $movimentacao = $this->repositorio->save($dados);

        return $this->tratarOutput($movimentacao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $movimentacao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($movimentacao);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'prer_descricao' => $input['descricao'],
            'prer_slug' => Str::slug($input['descricao']),
        ];
    }

    protected function tratarOutput(MovimentacaoModel $movimentacaoModel)
    {
        return [
            'id' => $movimentacaoModel->prer_id,
            'descricao' => $movimentacaoModel->prer_descricao,
            'slug' => $movimentacaoModel->prer_slug,
        ];
    }
}