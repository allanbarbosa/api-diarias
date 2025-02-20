<?php
declare(strict_types=1);

namespace Diarias\Municipio;

use Diarias\Municipio\Models\MunicipioModel;
use Diarias\Municipio\Repositorios\MunicipioRepositorio;
use Illuminate\Support\Str;

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
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
            'muni_slug' => Str::slug($input['slug']),
            'muni_porcentagem_diaria' => $input['porcentagemDiaria'],
            'muni_codigo_ibge' => $input['codigoIbge'],
            'id_estado' => $input['idEstado']
            
        ];
    }

    protected function tratarOutput(MunicipioModel $municipioModel)
    {
        return [
            'id' => $municipioModel->muni_id,
            'nome' => $municipioModel->muni_nome,
            'slug' => $municipioModel->muni_slug,
            'porcentagemDiaria' => $municipioModel->muni_porcentagem_diaria,
            'codigoIbge' => $municipioModel->muni_codigo_ibge,
            'idEstado' => $municipioModel->id_estado,
            'estado' =>
            [
                'id' => $municipioModel->estado->esta_id,
                'nome' => $municipioModel->estado->esta_nome,
            ]
        ];
    }
}