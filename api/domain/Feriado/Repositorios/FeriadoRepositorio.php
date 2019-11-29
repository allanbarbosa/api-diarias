<?php
declare(strict_types=1);

namespace Diarias\Feriado\Repositorios;

use Diarias\Feriado\Models\FeriadoModel;
use Exception;

class FeriadoRepositorio
{
    protected $model;

    protected $fields = [
        'feri_dia',
        'feri_mes',
        'feri_nome',
    ];

    public function __construct(FeriadoModel $feriadoModel)
    {
        $this->model = $feriadoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('feri_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Feriado não encontrado.');
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

    public function delete(int $id)
    {
        $model = $this->find($id);

        return $model->delete();
    }
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('feri_dia', 'feri_mes', 'feri_nome', 'ASC');

        if (isset($input['feri_dia'])) {
            $model = $model->where('feri_dia', '=', '%'.$input['feri_dia'].'%');
        }
        
        if (isset($input['feri_mes'])) {
            $model = $model->where('feri_mes', '=', '%'.$input['feri_mes'].'%');
        }
        
        if (isset($input['feri_nome'])) {
            $model = $model->where('feri_nome', 'ilike', '%'.$input['feri_nome'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}