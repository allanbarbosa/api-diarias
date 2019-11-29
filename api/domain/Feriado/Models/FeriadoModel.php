<?php
declare(strict_types=1);

namespace Diarias\Feriado\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeriadoModel extends Model
{
    protected $table = 'feriados';

    protected $primaryKey = 'feri_id';

    protected $fillable = [
        'feri_dia',
        'feri_mes',
        'feri_nome',
    ];

    use SoftDeletes;
}