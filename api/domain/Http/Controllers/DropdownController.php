<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Dropdown\EmpresaDropdown;
use Diarias\Dropdown\EscolaridadeDropdown;
use Diarias\Dropdown\ProfissaoDropdown;

class DropdownController extends Controller
{

    public function index(string $slug)
    {
        $metodo = $this->prepareMethod($slug);

        if (!method_exists($this, $metodo)) {
            return response()->json(['mensagem' => 'Método não encontrado.'], 500);
        }

        return response()->json($this->$metodo());
    }

    protected function prepareMethod(string $slug)
    {
        $nome = explode('-', $slug);

        $metodo = $nome[0];

        foreach ($nome as $key => $value) {
            if ($key > 0) {
                $metodo .= ucfirst($value);
            }
        }

        return $metodo;
    }

    protected function profissao()
    {

        $profissaoDropdown = new ProfissaoDropdown();

        return $profissaoDropdown->getDados();
    }

    protected function escolaridade()
    {
        $escolaridadeDropdown = new EscolaridadeDropdown();

        return $escolaridadeDropdown->getDados();
    }

    protected function empresa()
    {
        $empresaDropdown = new EmpresaDropdown();

        return $empresaDropdown->getDados();

    }

}
