<?php
declare(strict_types=1);

namespace Diarias\Usuario\Models;

use Diarias\Perfil\Models\PerfilModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioModel extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'usua_id';

    use SoftDeletes;

    public function perfil()
    {
        return $this->belongsToMany(PerfilModel::class, 'usuario_perfil', 'usua_id', 'perf_id');
    }
}
