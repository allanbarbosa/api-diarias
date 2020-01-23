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
        
        $dados = [];

        foreach ($ferias as $feria) {
            $dados[] = $this->tratarOutput($feria);
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
            'feri_data_inicio' => $input['dataInicio'],
            'feri_data_fim' => $input['dataFim'],
            'id_funcionario' => $input['idFuncionario'],
        ];
    }

    protected function tratarOutput(FeriasModel $feriasModel)
    {
        return [
            'id' => $feriasModel->feri_id,
            'dataInicio' => $feriasModel->feri_data_inicio,
            'dataFim' => $feriasModel->feri_data_fim,
            'idFuncionario' => $feriasModel->id_funcionario,
            'funcionario' =>
            [
                'id' => $feriasModel->funcionario->func_id,
                'cpf' => $feriasModel->funcionario->func_cpf,
                'nome' => $feriasModel->funcionario->func_nome,
                'telefone' => $feriasModel->funcionario->func_telefone,
                'email' => $feriasModel->funcionario->func_email,
            ]
        ];
    }
}