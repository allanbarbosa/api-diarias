<?php
declare(strict_types=1);

namespace Diarias\Profissao\Repositorios;

use Diarias\Profissao\Models\ProfissaoModel;
use Exception;

class ProfissaoRepositorio
{
    protected $model;

    protected $fields = [
        'prof_nome',
        'prof_slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function __construct(ProfissaoModel $profissaoModel)
    {
        $this->model = $profissaoModel;
    }

    public function find(int $id)
    {
        $model = $this->model->where('prof_id', '=', $id)->first();

        if (!$model)
        {
            throw new Exception('Profissão não encontrada');
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

        return $model->delete();
    }

    public function getWhere(array $input)
    {
        $model = $this->model->orderBy('prof_nome', 'ASC');

        if (isset($input['prof_nome']))
        {
            $model = $model->where('prof_nome', 'ilike', '%'.$input['prof_nome'].'%');
        }

        return $model->get();
    }
}