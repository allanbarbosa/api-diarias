<?php
declare(strict_types=1);

namespace Diarias\Escolaridade;

use Diarias\Escolaridade\Models\EscolaridadeModel;
use Diarias\Escolaridade\Repositorios\EscolaridadeRepositorio;
use Illuminate\Support\Str;

class EscolaridadeServico
{
    protected $repositorio;

    public function __construct(EscolaridadeRepositorio $escolaridadeRepositorio)
    {
        $this->repositorio = $escolaridadeRepositorio;
    }

    public function find(int $id)
    {
        $escolaridade = $this->repositorio->find($id);

        return $this->tratarOutput($escolaridade);
    }

    public function all(array $input)
    {
        $escolaridades = $this->repositorio->getWhere($input);

        $dados = [];

        foreach ($escolaridades as $escolaridade)
        {
            $dados[] = $this->tratarOutput($escolaridade);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $escolaridade = $this->repositorio->save($dados);

        return $this->tratarOutput($escolaridade);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $escolaridade = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($escolaridade);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'esco_nome' => $input['escolaridade'],
            'esco_slug' => Str::slug($input['slug']),
        ];
    }

    protected function tratarOutput(EscolaridadeModel $escolaridadeModel)
    {
        return [
            'id' => $escolaridadeModel->esco_id,
            'escolaridade' => $escolaridadeModel->esco_nome,
            'slug' => $escolaridadeModel->esco_slug,
        ];
    }
}