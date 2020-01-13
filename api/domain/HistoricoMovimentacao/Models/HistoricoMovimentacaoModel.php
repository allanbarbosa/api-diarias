<?php
declare(strict_types=1);

namespace Diarias\HistoricoMovimentacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricoMovimentacaoModel extends Model
{
    protected $table = 'historico_movimentacao';

    protected $primaryKey = 'hist_mov_id';

    protected $fillable = [
        'hist_mov_data_tramitacao',
        'hist_mov_observacao',
    ];

    use SoftDeletes;
}