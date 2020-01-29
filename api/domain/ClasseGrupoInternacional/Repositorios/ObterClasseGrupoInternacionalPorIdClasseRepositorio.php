<?php
declare(strict_type=1);

namespace Diarias\ClasseGrupoInternacional\Repositorios;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Exception;

class ObterClasseGrupoInternacionalPorIdClasseRepositorio
{
    protected $model;

    protected $fields = [
        
        'idClasse',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function __construct(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        $this->model = $classeGrupoInternacionalModel;
    }

    public function find(int $idClasse)
    {
        $model = $this->model->where('id_classe', '=', $idClasse)->first();

        if (!$model) {
            throw new Exception('Classe grupo internacional por classe não encontrada.');
        }
        return $model;
    }
        
        public function getWhere(array $input)
        {
            $model = $this->model->orderBy('idClasse', 'ASC');
                            
                if (isset($input['idClasse']))
                {
                    $model = $model->where('id_classe', '=', $input['idClasse']);
                }                

        return $model->get();
    }
}