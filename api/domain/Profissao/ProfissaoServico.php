<?php
declare(strict_types=1);

namespace Diarias\Profissao;

use Diarias\Profissao\Models\ProfissaoModel;
use Diarias\Profissao\Repositorios\ProfissaoRepositorio;
use Illuminate\Support\Str;

class ProfissaoServico
{
    protected $repositorio;

    public function __construct(ProfissaoRepositorio $profissaoRepositorio)
    {
        $this->repositorio = $profissaoRepositorio;
    }

    public function find(int $id)
    {
        $profissao = $this->repositorio->find($id);

        return $this->tratarOutput($profissao);
    }

    public function all(array $input)
    {
        $profissoes = $this->repositorio->getWhere($input);

        $dados = [
            'itens' => [],
            'total' => 0,
        ];

        foreach ($profissoes as $profissao)
        {
            $dados['itens'][] = $this->tratarOutput($profissao);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $profissoes->total();
        }
        else
        {
            $dados['total'] = count($profissoes); 
        }

        return $dados;

    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);

        $profissao = $this->repositorio->save($dados);

        return $this->tratarOutput($profissao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);

        $profissao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($profissao);
    }

    public function delete(int $id)
    {
        return $this->repositorio->delete($id);
    }

    protected function tratarInput(array $input)
    {
        return [
            'prof_nome' => $input['nome_prof'],
            'prof_slug' => Str::slug($input['nome_prof']),
        ];
    }

    protected function tratarOutput(ProfissaoModel $profissaoModel)
    {
        return [
            'id' => $profissaoModel->prof_id,
            'prof_nome' => $profissaoModel->prof_nome,
            'slug' => $profissaoModel->prof_slug,
        ];
    }
}