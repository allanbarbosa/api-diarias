<?php
declare(strict_types=1);

namespace Diarias\Ferias;

use Diarias\Ferias\Models\FeriasModel;
use Diarias\Ferias\Repositorios\FeriasRepositorio;

class FeriasServico
{
    protected $repositorio;

    public function __construct(FeriasRepositorio $feriasRepositorio)
    {
        $this->repositorio = $feriasRepositorio;
    }

    public function find(int $id)
    {
        $feria = $this->repositorio->find($id);

        return $this->tratarOutput($feria);
    }

    public function all(array $input)
    {
        $ferias = $this->repositorio->getWhere($input);
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($ferias as $feria) {
            $dados['itens'][] = $this->tratarOutput($feria);
        }

        if (isset($input['count'])) {
            $dados['total'] = $ferias->total();
        } else {
            $dados['total'] = count($ferias);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $feria = $this->repositorio->save($dados);

        return $this->tratarOutput($feria);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $feria = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($feria);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'feri_data_inicio' => $input['data_inicio'],
            'feri_data_fim' => $input['data_fim'],
            'id_funcionario' => $input['funcionario'],
        ];
    }

    protected function tratarOutput(FeriasModel $feriasModel)
    {
        return [
            'id' => $feriasModel->feri_id,
            'data_inicio' => $feriasModel->feri_data_inicio,
            'data_fim' => $feriasModel->feri_data_fim,
            'funcionario' => $feriasModel->id_funcionario,
        ];
    }
}