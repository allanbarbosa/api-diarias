<?php
declare(strict_types=1);

namespace Diarias\Usuario\Models;

use Diarias\Perfil\Models\PerfilModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Funcionario\Models\FuncionarioModel;

class UsuarioModel extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'usua_id';

    use SoftDeletes;

    public function perfil()
    {
        return $this->belongsToMany(PerfilModel::class, 'usuario_perfil', 'id_usuario', 'id_perfil');
    }
    
    public function funcionario()
    {
        return $this->belongsTo(FuncionarioModel::class, 'id_funcionario');    
    }
}
