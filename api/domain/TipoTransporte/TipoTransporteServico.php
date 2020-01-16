<?php
declare(strict_types=1);

namespace Diarias\TipoTransporte;

use Diarias\TipoTransporte\Models\TipoTransporteModel;
use Diarias\TipoTransporte\Repositorios\TipoTransporteRepositorio;
use Illuminate\Support\Str;


class TipoTransporteServico
{
    protected $repositorio;

    public function __construct(TipoTransporteRepositorio $tipoTransporteRepositorio)
    {
        $this->repositorio = $tipoTransporteRepositorio;
    }

    public function find(int $id)
    {
        $tipoTransporte = $this->repositorio->find($id);

        return $this->tratarOutput($tipoTransporte);
    }

    public function all(array $input)
    {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $tipoTransporte = $this->repositorio->save($dados);

        return $this->tratarOutput($tipoTransporte);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $tipoTransporte = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($tipoTransporte);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'tipo_tra_nome' => $input['nome'],
            'tipo_tra_slug' => Str::slug($input['slug']),
        ];
    }

    protected function tratarOutput(TipoTransporteModel $tipoTransporteModel)
    {
        return [
            'id' => $tipoTransporteModel->tipo_tra_id,
            'nome' => $tipoTransporteModel->tipo_tra_nome,
            'slug' => $tipoTransporteModel->tipo_tra_slug,
        ];
    }
}