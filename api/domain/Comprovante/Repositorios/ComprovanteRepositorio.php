<?php
declare(strict_types=1);

namespace Diarias\Comprovante\Repositorios;

use Diarias\Comprovante\Models\ComprovanteModel;
use Exception;


class ComprovanteRepositorio
{
    protected $model;

    protected $fields = [
        'compe_caminho',
        'compe_nome_arquivo',
        'id_comprovacao',
        'id_tipo_comprovante',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(ComprovanteModel $comprovanteModel)
    {
        $this->model = $comprovanteModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('compe_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Comprovante não encontrada.');
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
        $model = $this->model->orderBy('compe_caminho', 'ASC');

        if (isset($input['compe_caminho'])) {
            $model = $model->where('compe_caminho', 'ilike', '%'.$input['compe_caminho'].'%');
        }

        return $model->get();
    }
}