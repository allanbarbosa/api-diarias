<?php
declare(strict_types=1);

namespace Diarias\Dropdown;

use Diarias\Profissao\Models\ProfissaoModel;

class ProfissaoDropdown
{
    public function getDados()
    {
        $profissoes = ProfissaoModel::orderBy('prof_nome', 'ASC')->get();

        $dados = [];

        foreach ($profissoes as $profissao) {
            $dados[] = [
                'value' => $profissao->prof_id,
                'label' => $profissao->prof_nome,
            ];
        }

        return $dados;
    }
}
