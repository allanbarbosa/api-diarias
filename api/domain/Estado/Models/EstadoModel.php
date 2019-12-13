<?php
declare(strin_types=1);

namespace Diarias\Estado\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoModel extends Model
{
    protected $table = 'estado';

    protected $primaryKey = 'esta_id';

    protected $fillable = [
        'esta_sigla',
        'esta_nome',
    ];

    use SoftDeletes;
}
