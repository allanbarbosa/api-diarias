<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacional\Models;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Diarias\GrupoInternacionalPais\Models\GrupoInternacionalPaisModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoInternacionalModel extends Model
{
    protected $table = 'grupo_internacional';

    protected $primaryKey = 'grup_int_id';

    protected $fillable = [
        'grup_int_codigo'
    ];
    
    public function grupo_internacional_paises()
    {
        return $this->hasMany(GrupoInternacionalPaisModel::class, 'id_grupo_internacional');
    }
    
    public function classes_x_grupos_internacionais()
    {
        return $this->hasMany(ClasseGrupoInternacionalModel::class, 'id_grupo_internacional');
    }

    use SoftDeletes;
}