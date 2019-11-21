<?php
declare(strict_types=1);

namespace Diarias\Http\Middlewares;

use Diarias\Autenticacao\AutenticacaoServico;
use Closure;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class TokenValidationMiddleware
{
    protected $servico;

    public function __construct(AutenticacaoServico $autenticacaoServico)
    {
        $this->servico = $autenticacaoServico;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next)
    {
        try {

            $token = $request->bearerToken();

            if ($token === null) {
                return response()->json(['mensagem' => 'Token não informado'], 500);
            }

            $dados = $this->servico->extrairDados($token);

            $request->request->add(['usuario' => $dados->data->id]);

            return $next($request);

        } catch (ExpiredException $e) {

            return response()->json(['mensagem' => 'Token expirado'], 401);
        }
    }
}
