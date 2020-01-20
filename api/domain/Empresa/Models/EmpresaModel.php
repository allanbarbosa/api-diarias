<?php
declare(strict_types=1);

namespace Diarias\Empresa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaModel extends Model
{
    protected $table = 'empresa';

    protected $primaryKey = 'empr_id';

    protected $fillable = [
        'empr_nome',
        'empr_sigla',
    ];

    use SoftDeletes;
}
