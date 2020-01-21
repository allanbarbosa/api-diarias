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

        $dados = [];

        foreach ($profissoes as $profissao)
        {
            $dados[] = $this->tratarOutput($profissao);
        }

        return $dados;

    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $profissao = $this->repositorio->save($dados);

        return $this->tratarOutput($profissao);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $profissao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($profissao);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'prof_nome' => $input['profissao'],
            'prof_slug' => Str::slug($input['slug']),
        ];
    }

    protected function tratarOutput(ProfissaoModel $profissaoModel)
    {
        return [
            'id' => $profissaoModel->prof_id,
            'profissao' => $profissaoModel->prof_nome,
            'slug' => $profissaoModel->prof_slug,
        ];
    }
}