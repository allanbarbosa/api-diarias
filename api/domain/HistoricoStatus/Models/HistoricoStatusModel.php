<?php
declare(strict_types=1);

namespace Diarias\HistoricoStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricoStatusModel extends Model
{
    protected $table = 'historico_status';

    protected $primaryKe = 'hist_sta_id';

    protected $fillable = [
        'hist_sta_data_tramitacao',
        'hist_sta_observacao',
    ];

    use SoftDeletes;
}