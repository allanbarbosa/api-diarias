<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacional;

use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;
use Diarias\GrupoInternacional\Repositorios\GrupoInternacionalRepositorio;

class GrupoInternacionalServico
{
    protected $repositorio;

    public function __construct(GrupoInternacionalRepositorio $grupointernacionalRepositorio)
    {
        $this->repositorio = $grupointernacionalRepositorio;
    }

    public function find(int $id)
    {
        $grupointernacional = $this->repositorio->find($id);

        return $this->tratarOutput($grupointernacional);
    }

    public function all(array $input)
    {
        $grupointernacionais = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'total' => 0
        ];

        foreach ($grupointernacionais as $grupointernacional) {
            $dados['itens'][] = $this->tratarOutput($grupointernacional);
        }

        if (isset($input['count'])) {
            $dados['total'] = $grupointernacionais->total();
        } else {
            $dados['total'] = count($grupointernacionais);
        }

        return $dados;
    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $grupointernacional = $this->repositorio->save($dados);

        return $this->tratarOutput($grupointernacional);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $grupointernacional = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($grupointernacional);
    }

    public function delete(int $id, int $usuario)
    {

        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input)
    {
        return [
            'grup_int_codigo' => $input['codigo'],
            
        ];
    }

    protected function tratarOutput(GrupoInternacionalModel $grupointernacionalModel)
    {
        return [
            'id' => $grupointernacionalModel->grup_int_id,
            'codigo' => $grupointernacionalModel->grup_int_codigo,
            
        ];
    }
}