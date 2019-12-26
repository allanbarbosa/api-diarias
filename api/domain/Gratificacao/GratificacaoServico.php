<?php
declare(strict_types=1);

namespace Diarias\Gratificacao;

use Diarias\Gratificacao\Models\GratificacaoModel;
use Diarias\Gratificacao\Repositorios\GratificacaoRepositorio;

class GratificacaoServico
{
    protected $repositorio;

    public function __construct(GratificacaoRepositorio $gratificacaoRepositorio)
    {
      $this->repositorio = $gratificacaoRepositorio;
    }

    public function find(int $id)
    {
      $gratificacao = $this->repositorio->find($id);

      return $this->tratarOutput($gratificacao);
    }

    public function all(array $input)
    {
      $gratificacoes = $this->repositorio->getWhere($input);
      $dados = [
        'itens' => [],
        'todos' => 0,
      ];

      foreach ($gratificacoes as $gratificacao)
      {
        $dados['itens'][] = $this->tratarOutput($gratificacao);
      }

      if (isset($input['count']))
      {
        $dados['total'] = $gratificacoes->total();
      } 
      else
      {
        $dados['total'] = count($gratificacoes);
      }
      return $dados;
    }

    public function save(array $input)
    {
      $dados = $this->tratarInput($input);
      $dados['created_by'] = $input['usuario'];

      $gratificacao = $this->repositorio->save($dados);

      return $this->tratarOutput($gratificacao);
    }

    public function update(array $input, int $id)
    {
      $dados = $this->tratarInput($input);
      $dados['updated_by'] = $input['usuario'];

      $gratificacao = $this->repositorio->update($dados, $id);

      return $this->tratarOutput($gratificacao);
    }

    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
      return [
        'grat_nome' => $input['nome'],
        'grat_valor_diaria' => $input['valorDiaria'],
        'id_classe' => $input['classe']
      ];
    }

    protected function tratarOutput(GratificacaoModel $gratificacaoModel)
    {
      return [
        'id' => $gratificacaoModel->grat_id,
        'nome' => $gratificacaoModel->grat_nome,
        'valorDiaria' => $gratificacaoModel->grat_valor_diaria,
        'classe' =>
        [
          'id' => $gratificacaoModel->id_classe,
          'nome' => $gratificacaoModel->classe->clas_nome
        ]
      ];
    }
}