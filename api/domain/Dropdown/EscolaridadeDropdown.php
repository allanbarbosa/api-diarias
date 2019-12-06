<?php
declare(strict_types=1);

namespace Diarias\Dropdown;

use Diarias\Escolaridade\Models\EscolaridadeModel;

class EscolaridadeDropdown
{
    public function getDados()
    {
        $escolaridades = EscolaridadeModel::orderBy('esco_nome', 'ASC')->get();

        $dados = [];

        foreach ($escolaridades as $key => $escolariade) {
            $dados[] = [
                'value' => $escolariade->esco_id,
                'label' => $escolariade->esco_nome,
            ];
        }

        return $dados;
    }
}
