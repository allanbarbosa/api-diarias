<?php
declare(strict_types=1);

namespace Diarias\Profissao\Repositorios;

use Diarias\Empresa\Models\ProfissaoModel;
use Exception;

class ProfissaoRepositorio
{
    protected $model;

    protected $fildes = [
        'prof_nome',
        'prof_slug',
    ];

    public function __construct(ProfissaoModel $profissaoModel)
    {
        $this->model->profissaoModel;
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
        foreach ($this->fildes as $filde)
        {
            if (isset($input[$filde]))
            {
                $this->model{$filde} = $input[$filde];
            }
        }

        $this->model->save();

        return $this->model;
    }

    public function update(array $input, int $id)
    {
        $model = $this->find($id);

        foreach ($this->fildes as $filde)
        {
            if (isset($input[$filde]))
            {
                $model{$filde} = $input[$filde];
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

        if (isset($input['count']))
        {
            return $model->paginate($input['cout']);
        }

        return $model->get();
    }
}