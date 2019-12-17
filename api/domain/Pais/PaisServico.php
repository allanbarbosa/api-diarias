<?php
declare(strict_types=1);

namespace Diarias\Pais;

use Diarias\Pais\Models\PaisModel;
use Diarias\Pais\Repositorios\PaisRepositorio;

class PaisServico
{
  protected $repositorio;

  public function __construct(PaisRepositorio $paisRepositorio)
  {
    $this->repositorio = $paisRepositorio;
  }

  public function find(int $id)
  {
    $pais = $this->repositorio->find($id);

    return $this->tratarOutput($pais);
  }

  public function all(array $input)
  {
    $paises = $this->repositorio->getWhere($input);
    $dados = [
        'itens' => [],
        'todos' => 0,
    ];

    foreach ($paises as $pais)
    {
        $dados['itens'][] = $this->tratarOutput($pais);
    }

    if (isset($input['count']))
    {
        $dados['total'] = $paises->total();
    } 
    else
    {
        $dados['total'] = count($paises);
    }
    return $dados;
  }

  public function save(array $input)
  {
    $dados = $this->tratarInput($input);
    $dados['created_by'] = $input['usuario'];

    $pais = $this->repositorio->save($dados);

    return $this->tratarOutput($pais);
  }

  public function update(array $input, int $id)
  {
    $dados = $this->tratarInput($input);
    $dados['updated_by'] = $input['usuario'];

    $pais = $this->repositorio->update($dados, $id);

    return $this->tratarOutput($pais);
  }

  public function delete(int $id, int $usuario)
  {
    return $this->repositorio->delete($id, $usuario);
  }

  protected function tratarInput(array $input)
  {
    return [
      'pais_nome' => $input['nome'],
      'pais_codigo' => $input['codigo'],
      'id_grupo_internacional' => $input['grupoInternacional'],
    ];
  }

  protected function tratarOutput(PaisModel $paisModel)
  {
    return [
      'id' => $paisModel->pais_id,
      'nome' => $paisModel->pais_nome,
      'codigo' => $paisModel->pais_codigo,
      'grupoInternacional' =>
      [
          'id' => $paisModel->id_grupo_internacional,
          'codigo' => $paisModel->grupoInternacional->grup_int_codigo,
      ]
    ];
  }
}