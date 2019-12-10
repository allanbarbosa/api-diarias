<?php
declare(strict_types=1);

namespace Diarias\Usuario\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioModel extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'usua_id';

    use SoftDeletes;

    public function perfil()
    {
        public function perfil()
        {
            return $this->belongsToMany('App\Role', 'role_user_table', 'user_id', 'role_id');
        }
    }
}
