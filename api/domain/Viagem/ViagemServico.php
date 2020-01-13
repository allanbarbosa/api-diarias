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
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($viagens as $viagem) {
            $dados['itens'][] = $this->tratarOutput($viagem);
        }

        if (isset($input['count'])) {
            $dados['total'] = $viagens->total();
        } else {
            $dados['total'] = count($viagens);
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
            'viag_justificativa_feriado_fds' => $input['just_feriado'],
            'viag_justificativa_reprogramacao' => $input['just_reprog'],
            'viag_flag_alimentacao_custeada' => $input['flag_ali_cust'],
            'viag_flag_adicional_deslocamento' => $input['flag_adic_desl'],
            'viag_flag_urgente' => $input['flag_urgente'],
            
        ];
    }

    protected function tratarOutput(ViagemModel $viagemModel)
    {
        return [
            'id' => $viagemModel->viag_id,
            'objetivo' => $viagemModel->viag_objetivo,
            'just_feriado' => $viagemModel->viag_justificativa_feriado_fds,
            'just_reprog' => $viagemModel->viag_justificativa_reprogramacao,
            'flag_ali_cust' => $viagemModel->viag_flag_alimentacao_custeada,
            'flag_adic_desl' => $viagemModel->viag_flag_adicional_deslocamento,
            'flag_urgente' => $viagemModel->viag_flag_urgente,
        ];
    }
}