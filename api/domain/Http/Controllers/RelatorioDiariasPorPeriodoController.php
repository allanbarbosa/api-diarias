<?php
declare(strict_types=1);

namespace Diarias\Http\Controllers;

use App\Http\Controllers\Controller;
use Diarias\Relatorios\RelatorioDiariasPorPeriodoServico;
use Maatwebsite\Excel\Facades\Excel;

class RelatorioDiariasPorPeriodoController extends Controller
{
    public function index()
    {
        return Excel::download(new RelatorioDiariasPorPeriodoServico, 'resultado.xlsx');
    }
}
