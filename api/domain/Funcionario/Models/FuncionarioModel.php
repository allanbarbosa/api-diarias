<?php
declare(strict_types=1);

namespace Diarias\Funcionario\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuncionarioModel extends Model
{
    protected $table = 'funcionario';

    protected $primaryKey = 'func_id';

    protected $fillable = [
        'func_cpf',
        'func_nome',
        'func_telefone',
    ];

    use SoftDeletes;


}
