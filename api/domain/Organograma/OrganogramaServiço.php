<?php                   

declare(strict_types=1);

namespace Diarias\Organograma;

use Diarias\Organograma\Moldes\OrganogramaModel;
use Diarias\Organograma\Repositorios\OrganogramaRepositorio;


class OrganogramaServico
{

    protected $repositorio;

    public function __construct(OrganogramaRepositorio $organogramaRepositorio)
    {
        $this->repositorio = $organogramaRepositorio;  
    }

    public function find(int $id)
    {
        $organograma = $this->repositorio->find($id);

        return $this->tratarOutput($organograma);

    }

    public function all(array $input)
    {

        $organogramas = $this->repositorio->getwhere($input);

        $dados = [
            'itens' => [],
            'Total' => 0
        ];
    
        foreach ($organogramas as $organograma) {
            $dados['itens'][] = $this->tratarOutput($organograma);
        }

        if (isset($input['count'])) {

            $dados['total'] = $organograma->total();
        } else {
            $dados['total'] = count($organogramas);
        }

        return $dados;

    }

    public function save(array $input)
    {
        $dados = $this->tratarInput($input);
        $dados = [updated_by] = $input['usuario'];

        $organograma = $this->repositorio->save($dados);

        return $this->tratarOutput($organograma);
    }

    public function update(array $input, int $id)
    {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $organograma = $this->repositorio->save($dados, $id);

        return $this->tratarOutput($organograma);

    }
    public function delete(int $id, int $usuario)
    {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function TratarInput(array $input)
    {
        return [
            'orga_codigo' => $input['codigo'],
            'orga_data_inicio' => $input['codigo'],
            'orga_data_fim' => $input['codigo']
        ];
    }
    protected function tratarOutput(OrganogramaModel $organogramaModel)
    {

        return [
             'id' => $organogramaModel->org_id,
             'codigo' => $organogramaModel->org_codigo,   
             'data' => $organogramaModel->org_data_inicio,
             'data' => $organogramaModel->org_data_fim,   
        ];

    }
    }



}