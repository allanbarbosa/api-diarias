<?php
declare(strict_types=1);

namespace Diarias\Funcionario\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Empresa\Models\EmpresaModel;
use Diarias\Profissao\Models\ProfissaoModel;
Use Diarias\Escolaridade\Models\EscolaridadeModel;

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
}
