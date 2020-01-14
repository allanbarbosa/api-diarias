<?php
declare(strict_types=1);

namespace Diarias\TrechoRoteiro\Repositorios;

use Diarias\TrechoRoteiro\Models\TrechoRoteiroModel;
use Exception;


class TrechoRoteiroRepositorio
{
    protected $model;

    protected $fields = [
        'trec_rot_data_hora_saida',
        'trec_rot_data_hora_retorno',
        'trec_rot_valor_unitario',
        'trec_rot_valor_adicional',
        'trec_rot_qtd_diarias',
        'id_tipo_transporte',
        'id_viagem',
        'id_pais_origem',
        'id_municipio_origem',
        'id_pais_destino',
        'id_municipio_destino',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(TrechoRoteiroModel $trechoRoteiroModel)
    {
        $this->model = $trechoRoteiroModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('trec_rot_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Trecho da viagem não encontrada.');
        }

        return $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->model->{$field} = $input[$field];
            }
        }

        $this->model->save();

        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $model->{$field} = $input[$field];
            }
        }

        $model->save();
        
        return $model;
    }

    public function delete(int $id, int $usuario)
    {
        $model = $this->find($id);

        $model->deleted_by = $usuario;
        $model->save();

        return $model->delete();
    }
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('trec_rot_data_hora_saida', 'ASC');

        if (isset($input['trec_rot_data_hora_saida'])) {
            $model = $model->where('trec_rot_data_hora_saida', 'ilike', '%'.$input['trec_rot_data_hora_saida'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}