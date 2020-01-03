<?php
declare(strict_types=1);

namespace Diarias\FuncionarioPrerrogativa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuncionarioPrerrogativaModel extends Model
{
    protected $table = 'funcionario_prerrogativa';

    protected $primaryKey = 'func_pre_id';

    protected $fillable = [
        'func_pre_data_inicio',
        'func_pre_data_fim',
    ];

    use SoftDeletes;
}