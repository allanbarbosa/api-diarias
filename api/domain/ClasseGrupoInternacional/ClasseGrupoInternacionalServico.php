<?php
declare(strict_types=1);

namespace Diarias\ClasseGrupoInternacional;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Diarias\ClasseGrupoInternacional\Repositorios\ClasseGrupoInternacionalRepositorio;


class ClasseGrupoInternacionalServico
{
    protected $repositorio;

    public function __construct(ClasseGrupoInternacionalRepositorio $classeGrupoInternacionalRepositorio)
    {
        $this->repositorio = $classeGrupoInternacionalRepositorio;
    }

    public function find(int $id)
    {
        $classeGrupoInternacional = $this->repositorio->find($id);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function all(array $input, $paginage = false)
    {
        $classeGrupoInternacionais = array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
        if (!$paginage) {
            return $classeGrupoInternacionais;
        }
        
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($classeGrupoInternacionais as $classeGrupoInternacional) {
            $dados['itens'][] = $this->tratarOutput($classeGrupoInternacional);
        }

        if (isset($input['count'])) {
            $dados['total'] = $classeGrupoInternacionais->total();
        } else {
            $dados['total'] = count($classeGrupoInternacionais);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $classeGrupoInternacional = $this->repositorio->save($dados);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $classeGrupoInternacional = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($classeGrupoInternacional);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return new ClasseGrupoInternacionalModel([
            'clas_gru_internacional_id' => array_key_exists('id', $input) ? $input['id'] : null,
            'clas_gru_internacional_valor' => array_key_exists('valor', $input) ? $input['valor'] : null,
            'id_classe' => array_key_exists('idClasse', $input) ? $input['idClasse'] : null,
            'classe' => array_key_exists('classe', $input) ? $input['classe'] : null,
            'id_grupo_internacional' => array_key_exists('idGrupoInternacional', $input) ? $input['idGrupoInternacional'] : null,
            'grupo_internacional' => array_key_exists('grupoInternacional', $input) ? $input['grupoInternacional'] : null
        ]);
    }

    protected function tratarOutput(ClasseGrupoInternacionalModel $classeGrupoInternacionalModel)
    {
        return [
            'id' => $model->clas_gru_internacional_id,
            'valor' => $model->clas_gru_internacional_valor,
            'idClasse' => $model->id_classe,
            'classe' =>
            [
                'id' => $model->classe->clas_id,
                'nome' => $model->classe->clas_nome,
            ],
            'idGrupoInternacional' => $model->id_grupo_internacional,
            'grupoInternacional' =>
            [
                'id' => $model->grupoInternacional->grup_int_id,
                'codigo' => $model->grupoInternacional->grup_int_codigo,
            ]
        ];
    }
}
