<?php
declare(strict_types=1);

namespace Diarias\Lotacao;

use Diarias\Lotacao\Models\LotacaoModel;
use Diarias\Lotacao\Repositorios\LotacaoRepositorio;

class LotacaoServico
{
  protected $repositorio;

  public function __construct(LotacaoRepositorio $lotacaoRepositorio)
  {
      $this->repositorio = $lotacaoRepositorio;
  }

  public function find(int $id)
  {
      $lotacao = $this->repositorio->find($id);

      return $this->tratarOutput($lotacao);
  }

  public function all(array $input)
  {
      $lotacoes = $this->repositorio->getWhere($input);
      $dados = [
        'itens' => [],
        'todos' => 0,
      ];

      foreach ($lotacoes as $lotacao)
      {
          $dados['itens'][] = $this->tratarOutput($lotacao);
      }

      if (isset($input['count']))
      {
          $dados['total'] = $lotacoes->total();
      } 
      else
      {
          $dados['total'] = count($lotacoes);
      }
      return $dados;
  }

  public function save(array $input)
  {
      $dados = $this->tratarInput($input);

      $lotacao = $this->repositorio->save($dados);

      return $this->tratarOutput($lotacao);
  }

  public function update(array $input, int $id)
  {
      $dados = $this->tratarInput($input);

      $lotacao = $this->repositorio->update($dados, $id);

      return $this->tratarOutput($lotacao);
  }

  public function delete(int $id)
  {
      return $this->repositorio->delete($id);
  }

  protected function tratarInput(array $input)
  {
      return [
          'lota_data_inicio' => $input['dataInicio'],
          'id_cargo' => $input['cargo'],
          'id_vinculo_empregaticio' => $input['vinculo_empregaticio'],
          'id_unidade_organograma' => $input['unidade_organograma']
      ];
  }

  protected function tratarOutput(LotacaoModel $lotacaoModel)
  {
    return [
      'id' => $lotacaoModel->lota_id,
      'dataInicio' => $lotacaoModel->lota_data_inicio,
      'dataFim' => $lotacaoModel->lota_data_fim,
      'cargo' =>
      [
        'id' => $lotacaoModel->id_cargo,
        'nome' => $lotacaoModel->cargo->carg_nome
      ],
      'vinculo_empregaticio' =>
      [
        'id' => $lotacaoModel->id_vinculo_empregaticio,
        'matricula' => $lotacaoModel->vinculo_empregaticio->vinc_emp_matricula,
        'dataAdmissao' => $lotacaoModel->vinculo_empregaticio->vinc_emp_data_admissao,
        'dataDesligamento' => $lotacaoModel->vinculo_empregaticio->vinc_emp_data_desligamento,
      ],
      'unidade_organograma' =>
      [
        'id' => $lotacaoModel->id_unidade_organograma,
        'idUnidadePai' => $lotacaoModel->unidade_organograma->id_unidade_pai
      ]
    ];
  }
}