<?php
declare(strict_types=1);

namespace Diarias\Municipio;

use Diarias\Municipio\Models\MunicipioModel;
use Diarias\Municipio\Repositorios\MunicipioRepositorio;

class MunicipioServico
{
    protected $repositorio;

    public function __construct(MunicipioRepositorio $municipioRepositorio)
    {
        $this->repositorio = $municipioRepositorio;
    }

    public function find(int $id)
    {
        $municipio = $this->repositorio->find($id);

        return $this->tratarOutput($municipio);
    }

    public function all(array $input)
    {
        $municipios = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'todos' => 0,
        ];

        foreach ($municipios as $municipio)
        {
            $dados['itens'][] = $this->tratarOutput($municipio);
        }

        if (isset($input['count']))
        {
            $dados['total'] = $municipios->total();
        } 
        else
        {
            $dados['total'] = count($municipios);
        }
        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $municipio = $this->repositorio->save($dados);

        return $this->tratarOutput($municipio);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $municipio = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($municipio);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'muni_nome' => $input['nome'],
            'muni_slug' => Str::slug($input['nome']),
            'muni_porcentagem_diaria' => $input['porcentagemDiaria'],
            'id_estado' => $input['estado']
        ];
    }

    protected function tratarOutput(MunicipioModel $municipioModel)
    {
        return [
            'id' => $municipioModel->muni_id,
            'nome' => $municipioModel->muni_nome,
            'slug' => $municipioModel->muni_slug,
            'porcentagemDiaria' => $municipioModel->muni_porcentagem_diaria,
            'estado' =>
            [
                'id' => $municipioModel->id_estado,
                'nome' => $municipioModel->estado->esta_nome,
            ]
        ];
    }
}