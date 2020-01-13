<?php
declare(strict_types=1);

namespace Diarias\Lotacao\Repositorios;

use Diarias\Lotacao\Models\LotacaoModel;
use Exception;

class LotacaoRepositorio
{
    protected $model;

    protected $fields = [
        'lota_data_inicio',
        'lota_data_fim',
        'id_cargo',
        'id_vinculo_empregaticio',
        'id_unidade_organograma'
    ];

    public function __construct(LotacaoModel $lotacaoModel)
    {
        $this->model = $lotacaoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('lota_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Lotação não encontrada');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $this->model->{$field} = $input[$field];
            }
        }
        $this->model->save();
        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field)
        {
            if (isset($input[$field]))
            {
                $model->{$field} = $input[$field];
            }
        }
        $model->save();

        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->find($id);

        $model->save();

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('lota_data_inicio', 'ASC');

        if (isset($input['lota_data_inicio']))
        {
            $model = $model->where('lota_data_inicio', '=', $input['lota_data_inicio']);
        }
        if (isset($input['idVinculoEmpregaticio']))
        {
            $model = $model->where('id_vinculo_empregaticio', '=', $input['idVinculoEmpregaticio']);
        }

        if (isset($input['count']))
        {
           return $model->paginate($input['count']);
        }
        return $model->get();
    }

    public function getLotacaoAtualDoVinculo(int $idVinculoEmpregaticio)
    {
        return $this->model->where('id_vinculo_empregaticio', '=', $idVinculoEmpregaticio)
                        ->whereNull('lota_data_fim')->first();
    }

    public function desligarLotacao(int $idLotacao, $dataDesligamento)
    {
        $lotacao = $this->model->find($idLotacao);
        $lotacao->lota_data_fim = $dataDesligamento;
        $lotacao->save();
        return $lotacao;
    }
}
