<?php
declare(strict_types=1);

namespace Diarias\Usuario;

use Diarias\Usuario\Repositorios\UsuarioRepositorio;

class DeleteUsuarioByFuncionarioServico
{
    protected $repositorio;

    public function __construct(UsuarioRepositorio $usuarioRepositorio)
    {
        $this->repositorio = $usuarioRepositorio;
    }

    public function delete(int $idFuncionario, int $usuario)
    {
        $usuarios = $this->repositorio->getWhere(['id_funcionario' => $idFuncionario]);

        if (count($usuarios) == 0) {
            return true;
        }

        foreach ($usuarios as $key => $value) {
            $this->repositorio->delete($value->usua_id, $usuario);
        }

        return true;
    }
}
