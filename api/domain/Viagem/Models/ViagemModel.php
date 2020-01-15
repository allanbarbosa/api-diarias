<?php
declare(strict_types=1);

namespace Diarias\Viagem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViagemModel extends Model
{
    protected $table = 'viagem';

    protected $primaryKey = 'viag_id';

    protected $fillable = [
        'viag_objetivo',
        'viag_justificativa_feriado_fds',
        'viag_justificativa_reprogramacao',
        'viag_flag_alimentacao_custeada',
        'viag_flag_adicional_deslocamento',
        'viag_flag_urgente',
        'lota_id',
    ];

    use SoftDeletes;
}