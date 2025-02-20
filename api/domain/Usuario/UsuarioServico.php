<?php
declare(strict_types=1);

namespace Diarias\Usuario;

use Diarias\Usuario\Models\UsuarioModel;
use Diarias\Usuario\Repositorios\UsuarioRepositorio;
use Illuminate\Support\Facades\Hash;

class UsuarioServico
{
    protected $repositorio;
    
    public function __construct(UsuarioRepositorio $usuarioRepositorio)
    {
        $this->repositorio = $usuarioRepositorio;
    }
    
    public function find(int $id)
    {
        $usuario = $this->repositorio->find($id);
        
        return $this->tratarOutput($usuario);
    }
    
    public function all(array $input)
    {
        $usuarios = $this->repositorio->getWhere($this->tratarFiltro($input));
        
        $dados = [];
        
        foreach ($usuarios as $usuario) {
            $dados[] = $this->tratarOutput($usuario);   
        }
        
        return $dados;
    }
    
    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];
        
        if (isset($input['perfil'])) {
            $dados['perfil'] = $input['perfil'];
        }
        
        $usuario = $this->repositorio->save($dados);
        
        return $this->tratarOutput($usuario);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $prerrogativa = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($prerrogativa);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }
    
    protected function tratarInput(array $input)
    {
        return [
            'usua_login' => $input['login'],
            'usua_nome' => $input['nome'],
            'usua_senha' => Hash::make('conder'),
            'id_funcionario' => (!is_null($input['funcionario'])) ? $input['funcionario'] : null,
        ];    
    }
    
    protected function tratarFiltro(array $input)
    {
        
        if (isset($input['nome'])) {
            $input['usua_nome'] = $input['nome'];
        }
        
        if (isset($input['login'])) {
            $input['usua_login'] = $input['login'];
        }
        
        if (isset($input['funcionario'])) {
            $input['id_funcionario'] = $input['funcionario'];
        }
        
        return $input;
    }
    
    protected function tratarOutput(UsuarioModel $usuarioModel)
    {
        // if (!is_null($usuarioModel->id_funcionario) && is_null($usuarioModel->funcionario)) {
        //     // dd($usuarioModel);
        // }
        $dados = [
            'id' => $usuarioModel->usua_id,
            'nome' => $usuarioModel->usua_nome,
            'login' => $usuarioModel->usua_login,
            'primeiroAcesso' => $usuarioModel->usua_primeiro_acesso,
            'idFuncionario' => $usuarioModel->id_funcionario,
            'funcionario' => [],
            'perfil' => []
        ];

        
        $perfis = $usuarioModel->perfil;
        
        foreach ($perfis as $perfil) {
            $dados['perfil'][] = [
                'id' => $perfil->perf_id,
                'nome' => $perfil->perf_descricao
            ];
        }

        if ($usuarioModel->funcionario) {
            $dados['funcionario'] = [
                'id' => $usuarioModel->funcionario->func_id,
                'cpf' => $usuarioModel->funcionario->func_cpf,
                'nome' => $usuarioModel->funcionario->func_nome,
                'telefone' => $usuarioModel->funcionario->func_telefone,
                'email' => $usuarioModel->funcionario->func_email,
                'idEmpresa' => $usuarioModel->funcionario->id_empresa,
                'idProfissao' => $usuarioModel->funcionario->id_profissao,
                'idEscolaridade' => $usuarioModel->funcionario->id_escolaridade,
            ];
        }
        
        return $dados;
    }
}
