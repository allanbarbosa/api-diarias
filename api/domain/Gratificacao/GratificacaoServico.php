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
        $gratificacoes = $this->repositorio->getWhere($input);
        $dados = [
            'itens' => [],
            'todos' => 0,
        ];

        foreach ($gratificacoes as $gratificacao) {
            $dados['itens'][] = $this->tratarOutput($gratificacao);
        }

        if (isset($input['count'])) {
            $dados['total'] = $gratificacoes->total();
        } else {
            $dados['total'] = count($gratificacoes);
        }
        return $dados;
    }

    public function save(array $input) {
        $dados = $this->tratarInput($input);
        $dados['created_by'] = $input['usuario'];

        $gratificacao = $this->repositorio->save($dados);

        return $this->tratarOutput($gratificacao);
    }

    public function update(array $input, int $id) {
        $dados = $this->tratarInput($input);
        $dados['updated_by'] = $input['usuario'];

        $gratificacao = $this->repositorio->update($dados, $id);

        return $this->tratarOutput($gratificacao);
    }

    public function delete(int $id, int $usuario) {
        return $this->repositorio->delete($id, $usuario);
    }

    protected function tratarInput(array $input) {
        return [
            'grat_id' => array_key_exists('id', $input) ? $input['id'] : null,
            'grat_nome' => array_key_exists('nome', $input) ? $input['nome'] : null,
            'grat_slug' => array_key_exists('slug', $input) ? $input['slug'] : Str::slug($input['nome']),
            'grat_valor_diaria' => array_key_exists('valorDiaria', $input) ? $input['valorDiaria'] : null,
            'id_classe' => array_key_exists('idClasse', $input) ? $input['idClasse'] : null
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
