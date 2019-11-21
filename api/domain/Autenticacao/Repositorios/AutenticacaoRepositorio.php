<?php
declare(strict_types=1);

namespace Diarias\Autenticacao\Repositorios;

use Diarias\Usuario\Models\UsuarioModel;

class AutenticacaoRepositorio
{
    protected $model;

    public function __construct(UsuarioModel $usuarioModel)
    {
        $this->model = $usuarioModel;
    }

    public function getWhere(array $input)
    {
        return $this->model->where('usua_login', '=', $input['usua_login'])->first();
    }
}
