<?php
declare(strict_types=1);

namespace Diarias\Prerrogativa\Repositorios;

use Diarias\Prerrogativa\Models\PrerrogativaModel;
use Exception;

class PrerrogativaRepositorio
{
    protected $model;

    protected $fields = [
        'prer_descricao',
        'prer_slug',
    ];

    public function __construct(PrerrogativaModel $prerrotivaModel)
    {
        $this->model = $prerrotivaModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('prer_id', '=', $id)->first();

        if (!$model) {
            throw new Exception('Prerrogativa não encontrada.');
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
        $model = $this->field($id);

        return $model->delete();
    }
    
    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('prer_descricao', 'ASC');

        if (isset($input['prer_descricao'])) {
            $model = $model->where('prer_descricao', 'ilike', '%'.$input['prer_descricao'].'%');
        }

        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }

        return $model->get();
    }
}
