<?php
declare(strict_types=1);

namespace Diarias\Http\Middlewares;

use Closure;
use Diarias\Usuario\UsuarioServico;

class CriacaoUsuarioMiddleware
{
    protected $servico;
    
    const FUNCIONARIO = 1;
    
    public function __construct(UsuarioServico $usuarioServico)
    {
        $this->servico = $usuarioServico;
    }
    
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if ($response->getStatusCode() !== 200) {
            return $response;
        }
        
        $dados = $response->getData();
        $nome = tratarLogin($dados->nome);
        $montagemLogin = explode(' ', $nome);
        
        $primeiroNome = strtolower($montagemLogin[0]);
        
        for ($i = count($montagemLogin)-1; $i > 0; $i--) {
            $login = $primeiroNome . strtolower($montagemLogin[$i]);
            
            $usuario = $this->servico->all(['login' => $login]);
            
        }
        
        $input = [
            'login' => $login,
            'nome' => $dados->nome,
            'funcionario' => $dados->id,
            'perfil' => [self::FUNCIONARIO],
            'usuario' => $request->get('usuario'),
        ];
        
        $usuario = $this->servico->save($input);
        
        $dados->login = $usuario['login'];
        $dados->idLogin = $usuario['id'];
        
        $response->setData($dados);
        
        return $response;
    }
}
