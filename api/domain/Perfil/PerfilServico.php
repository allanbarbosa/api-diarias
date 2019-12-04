<?php
declare(strict_types=1);

namespace Diarias\Perfil;

use Diarias\Perfil\Models\PerfilModel;
use Diarias\Perfil\Repositorios\PerfilRepositorio;
use Illuminate\Support\Str;

class PerfilServico
{
    protected $repositorio;

    public function __construct(PerfilRepositorio $perfilRepositorio)
    {
        $this->repositorio = $perfilRepositorio;
    }

    public function find(int $id)
    {
        $perfil = $this->repositorio->find($id);

        return $this->tratarOutput($perfil);
    }

    public function all(array $input)
    {
        $perfis = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($perfis as $perfil) {
            $dados['itens'][] = $this->tratarOutput($perfil);
        }

        if (isset($input['count'])) {
            $dados['total'] = $perfis->total();
        } else {
            $dados['total'] = count($perfis);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $perfil = $this->repositorio->save($dados);

        return $this->tratarOutput($perfil);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $perfil = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($perfil);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'perf_descricao' => $input['descricao'],
            'perf_slug' => Str::slug($input['descricao']),
        ];
    }

    protected function tratarOutput(PerfilModel $perfilModel)
    {
        return [
            'id' => $perfilModel->perf_id,
            'descricao' => $perfilModel->perf_descricao,
            'slug' => $perfilModel->perf_slug,
        ];
    }
}
