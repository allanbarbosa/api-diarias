<?php
declare(strict_types=1);

namespace Diarias\Http\Middlewares;

use Closure;
use Diarias\Usuario\DeleteUsuarioByFuncionarioServico;

class ApagarUsuarioMiddleware
{
    protected $servico;

    public function __construct(DeleteUsuarioByFuncionarioServico $usuarioServico)
    {
        $this->servico = $usuarioServico;
    }

    public function handle($request, Closure $next)
    {
        $idFuncionario = $request->id;
        
        $response = $next($request);

        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        $this->servico->delete((int)$idFuncionario, (int)$request->get('usuario'));

        return $response;

    }
}