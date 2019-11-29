<?php
declare(strict_types=1);

namespace Diarias\Parametros\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParametroModel extends Model
{
    protected $table = 'parametros';

    protected $primaryKey = 'para_id';

    protected $fillable = [
        'para_max_diarias_mes',
        'para_max_diarias_ano',
        'para_max_diarias_consecutivas',
    ];

    use SoftDeletes;
}