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
        'compo_diarias_utilizadas',
        'compo_data_hora_saida_efetiva',
        'compo_data_hora_chegada_efetiva',
        'compo_atividades_desenvolvidas',
        'compo_saldo_receber',
        'compo_saldo_restituir',
        'compo_valor_total',
    ];

    use SoftDeletes;
}