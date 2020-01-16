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
    return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
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
    return new PaisModel([
      'pais_id' => isset($input['id']) ? $input['id'] : null,
      'pais_nome' => isset($input['nome']) ? $input['nome'] : null
    ]);
  }

  protected function tratarOutput(PaisModel $paisModel)
  {
      
    return [
      'id' => $paisModel->pais_id,
      'nome' => $paisModel->pais_nome
    ];
  }
}