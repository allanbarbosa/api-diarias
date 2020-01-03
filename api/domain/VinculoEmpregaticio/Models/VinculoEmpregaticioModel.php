<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Funcionario\Models\FuncionarioModel;

class VinculoEmpregaticioModel extends Model
{
    protected $table = 'vinculo_empregaticio';

    protected $primaryKey = 'vinc_emp_id';

    protected $fillable = [
        'vinc_emp_matricula',
        'vinc_emp_data_admissao',
        'vinc_emp_data_desligamento'
    ];

    use SoftDeletes;

    public function funcionario()
    {
        return $this->belongsTo(FuncionarioModel::class, 'id_funcionario');
    }
}
