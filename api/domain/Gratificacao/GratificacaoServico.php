<?php

declare(strict_types=1);

namespace Diarias\Gratificacao;

use Diarias\Gratificacao\Models\GratificacaoModel;
use Diarias\Gratificacao\Repositorios\GratificacaoRepositorio;
use Illuminate\Support\Str;

class GratificacaoServico {

    protected $repositorio;

    public function __construct(GratificacaoRepositorio $gratificacaoRepositorio) {
        $this->repositorio = $gratificacaoRepositorio;
    }

    public function find(int $id) {
        $gratificacao = $this->repositorio->find($id);

        return $this->tratarOutput($gratificacao);
    }

    public function all(array $input) {
        return array_map(array($this, 'tratarOutput'), $this->repositorio->getWhere($input)->all());
    }

    public function save(array $input) {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $gratificacao = $this->repositorio->save($dados->toArray());

        return $this->tratarOutput($gratificacao);
    }

    public function update(array $input, int $id) {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $gratificacao = $this->repositorio->update($dados->toArray(), $id);

        return $this->tratarOutput($gratificacao);
    }

    public function delete(int $id, int $usuario) {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input) {
        return [
           
            'grat_nome' => $input['nome'],
            'grat_slug' => isset($input['slug']) ? $input['slug'] : Str::slug($input['slug']),
            'grat_valor_diaria' => $input['valorDiaria'],
            'id_classe' => $input['idClasse']

        ];
    }

    protected function tratarOutput(GratificacaoModel $model) {
        return [
            'id' => $model->grat_id,
            'nome' => $model->grat_nome,
            'slug' => $model->grat_slug,
            'valorDiaria' => $model->grat_valor_diaria,
            'idClasse' => $model->id_classe,
            'classe' =>
            [
                'id' => $model->classe->clas_id,
                'nome' => $model->classe->clas_nome
            ]
        ];
    }

}
