<?php
declare(strict_types=1);

namespace Diarias\Viagem;

use Diarias\Viagem\Models\ViagemModel;
use Diarias\Viagem\Repositorios\ViagemRepositorio;

class ViagemServico
{
    protected $repositorio;

    public function __construct(ViagemRepositorio $viagemRepositorio)
    {
        $this->repositorio = $viagemRepositorio;
    }

    public function find(int $id)
    {
        $viagem = $this->repositorio->find($id);

        return $this->tratarOutput($viagem);
    }

    public function all(array $input)
    {
        $viagens = $this->repositorio->getWhere($input);
        
        $dados = [];

        foreach ($viagens as $viagem) {
            $dados[] = $this->tratarOutput($viagem);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $viagem = $this->repositorio->save($dados);

        return $this->tratarOutput($viagem);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $viagem = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($viagem);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'viag_objetivo' => $input['objetivo'],
            'viag_justificativa_feriado_fds' => isset($input['justFeriado']) ? $input['justFeriado'] : null,
            'viag_justificativa_reprogramacao' => isset($input['justReprog']) ? $input['justReprog'] : null,
            'viag_flag_alimentacao_custeada' => isset($input['flagAliCust']) ? $input['flagAliCust'] : null,
            'viag_flag_adicional_deslocamento' => $input['flagAdicDesl'],
            'viag_flag_urgente' => $input['flagUrgente'],
            'lota_id' => $input['idLotacao'],
            
        ];
    }

    protected function tratarOutput(ViagemModel $viagemModel)
    {
        return [
            'id' => $viagemModel->viag_id,
            'objetivo' => $viagemModel->viag_objetivo,
            'justFeriado' => $viagemModel->viag_justificativa_feriado_fds,
            'justReprog' => $viagemModel->viag_justificativa_reprogramacao,
            'flagAliCust' => $viagemModel->viag_flag_alimentacao_custeada,
            'flagAdicDesl' => $viagemModel->viag_flag_adicional_deslocamento,
            'flagUrgente' => $viagemModel->viag_flag_urgente,
            'idLotacao' => $viagemModel->lota_id,
            'lotacao' =>
            [
                'id' => $viagemModel->lotacao->lota_id,
                'dataInicio' => $viagemModel->lotacao->lota_data_inicio,
                'dataFim' => $viagemModel->lotacao->lota_data_fim,
            ]
        ];
    }
}