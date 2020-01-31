<?php
declare(strict_types=1);

namespace Diarias\VinculoEmpregaticio\Models;

use Diarias\Funcionario\Models\FuncionarioModel;
use Diarias\Lotacao\Models\LotacaoModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function lotacao()
    {
        return $this->hasMany(LotacaoModel::class, 'id_vinculo_empregaticio');
    }

}
