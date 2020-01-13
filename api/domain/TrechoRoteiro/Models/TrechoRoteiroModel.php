<?php
declare(strict_types=1);

namespace Diarias\TrechoRoteiro\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrechoRoteiroModel extends Model
{
    protected $table = 'trecho_roteiro';

    protected $primaryKey = 'trec_rot_id';

    protected $fillable = [
        'trec_rot_data_hora_saida',
        'trec_rot_data_hora_retorno',
        'trec_rot_valor_unitario',
        'trec_rot_valor_adicional',
        'trec_rot_qtd_diarias',
    ];

    use SoftDeletes;
}