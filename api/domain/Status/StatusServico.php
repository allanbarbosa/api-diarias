<?php
declare(strict_types=1);

namespace Diarias\Status;

use Diarias\Status\Models\StatusModel;
use Diarias\Status\Repositorios\StatusRepositorio;
use Illuminate\Support\Str;

class StatusServico
{
    protected $repositorio;

    public function __construct(StatusRepositorio $statusRepositorio)
    {
        $this->repositorio = $statusRepositorio;
    }

    public function find(int $id)
    {
        $status = $this->repositorio->find($id);

        return $this->tratarOutput($status);
    }

    public function all(array $input)
    {
        $status = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($status as $statu) {
            $dados['itens'][] = $this->tratarOutput($status);
        }

        if (isset($input['count'])) {
            $dados['total'] = $status->total();
        } else {
            $dados['total'] = count($status);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $status = $this->repositorio->save($dados);

        return $this->tratarOutput($status);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $status = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($status);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'stat_nome' => $input['nome'],
            'stat_slug' => Str::slug($input['nome']),
        ];
    }

    protected function tratarOutput(StatusModel $statusModel)
    {
        return [
            'id' => $statusModel->stat_id,
            'nome' => $statusModel->stat_nome,
            'slug' => $statusModel->stat_slug,
        ];
    }
}
