<?php
declare(strict_types=1);

namespace Diarias\Funcionario\Models;

use Diarias\Empresa\Models\EmpresaModel;
use Diarias\Escolaridade\Models\EscolaridadeModel;
use Diarias\Profissao\Models\ProfissaoModel;
use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;
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
        'func_email'
    ];

    use SoftDeletes;

    public function empresa()
    {
        return $this->belongsTo(EmpresaModel::class, 'id_empresa');
    }

    public function profissao()
    {
        return $this->belongsTo(ProfissaoModel::class, 'id_profissao');
    }

    public function escolaridade()
    {
        return $this->belongsTo(EscolaridadeModel::class, 'id_escolaridade');
    }

    public function vinculo_empregaticio()
    {
        return $this->hasMany(VinculoEmpregaticioModel::class, 'id_vinculo_empregaticio');
    }
}
