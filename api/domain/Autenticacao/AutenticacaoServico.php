<?php
declare(strict_types=1);

namespace Diarias\Autenticacao;

use Diarias\Autenticacao\Repositorios\AutenticacaoRepositorio;
use Firebase\JWT\JWT;

class AutenticacaoServico
{
    protected $repositorio;

    protected $chave = '8xad012Amcd';

    protected $expiracao = 7200;

    protected $criptografia = 'HS256';

    public function __construct(AutenticacaoRepositorio $autenticacaoRepositorio)
    {
        $this->repositorio = $autenticacaoRepositorio;
    }

    public function autenticar(array $input)
    {
        $usuario = $this->repositorio->getWhere(['usua_login' => $input['login']]);

        if (!$usuario) {
            throw new \Exception('Usuário e senha inválidos');
        }

        if (!password_verify($input['senha'], $usuario->usua_senha)) {
            throw new \Exception('Usuário e senha inválidos.');
        }

        $dados = [
            'id' => $usuario->usua_id,
            'login' => $usuario->usua_login,
            'nome' => $usuario->usua_nome,
        ];

        $time = time();
        $expire = $time + $this->expiracao;

        $tokenParams = [
            'iat' => $time,
            'nbf' => $time - 1,
            'data' => $dados,
            'exp' => $expire
        ];

        $token = JWT::encode($tokenParams, $this->chave);

        return [
            'token' => $token,
            'nome' => $usuario->usua_nome,
            'login' => $usuario->usua_login,
        ];
    }

    public function extrairDados(string $token)
    {
        return JWT::decode($token, $this->chave, [$this->criptografia]);
    }
}
