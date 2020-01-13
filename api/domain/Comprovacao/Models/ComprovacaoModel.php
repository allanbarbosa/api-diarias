<?php
declare(strict_types=1);

namespace Diarias\Comprovacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComprovacaoModel extends Model
{
    protected $table = 'comprovacao';

    protected $primaryKey = 'compo_id';

    protected $fillable = [
        'comp_diarias_utilizadas',
        'comp_data_hora_saida_efetiva',
        'comp_data_hora_chegada_efetiva',
        'comp_atividades_desenvolvidas',
        'comp_saldo_receber',
        'comp_saldo_restituir',
        'comp_valor_total',
        'id_trecho',
    ];

    use SoftDeletes;
}