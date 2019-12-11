<?php
declare(strict_types=1);

namespace Diarias\Usuario\Repositorios;

use Diarias\Usuario\Models\UsuarioModel;
use Exception;

class UsuarioRepositorio
{
    protected $model;

    protected $fields = [
        'usua_login',
        'usua_nome',
        'usua_senha',
        'usua_primeiro_acesso',
        'id_funcionario',
        'created_by',
        'updated_by'
    ];

    public function __construct(UsuarioModel $usuarioModel)
    {
        $this->model = $usuarioModel;
    }

    public function find(int $id)
    {
        $usuario = $this->model->with(['perfil'])->where('usua_id', '=', $id)->first();

        if (!$usuario) {
            throw new Exception('Usuário não encontrado.');
        }
        
        return $usuario;
    }
    
    public function all()
    {
        return $this->model->orderBy('usua_nome', 'ASC')->get();    
    }
    
    public function save(array $input)
    {
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->model->{$field} = $input[$field];
            }
        }
        
        $this->model->save();
        
        if (isset($input['perfil'])) {
            $this->model->perfil()->sync($input['perfil']);
        }
        
        return $this->model;
    }
    
    public function update(array $input, int $id)
    {
        $model = $this->find($id);
        
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $model->$field = $input[$field];
            }
        }
        
        if (isset($input['perfil'])) {
            $model->perfil()->sync($input['perfil']);
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
        $model = $this->model->orderBy('usua_nome', 'ASC');
        
        if (isset($input['usua_login'])) {
            $model = $model->where('usua_login', '=', $input['usua_login']);
        }
        
        if (isset($input['usua_nome'])) {
            $model = $model->where('usua_nome', 'ilike', '%'.$input['usua_nome'].'%');
        }
        
        if (isset($input['id_funcionario'])) {
            $model = $model->where('id_funcionario', '=', $input['id_funcionario']);   
        }
        
        if (isset($input['count'])) {
            return $model->paginate($input['count']);
        }
        
        return $model->get();
    }
}
