<?php
declare (strict_types = 1);

namespace Diarias\GrupoInternacionalPais\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Pais\Models\PaisModel;
use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;

class GrupoInternacionalPaisModel extends Model
{
    protected $table = 'grupo_internacional_pais';

    protected $primaryKey = 'grup_int_pais_id';

    protected $fillable = [
        'id_pais',
        'id_grupo_internacional'
    ];

    use SoftDeletes;

    public function pais()
    {
        return $this->belongsTo(PaisModel::class, 'id_pais');
    }
    
    public function grupoInternacional()
    {
        return $this->belongsTo(GrupoInternacionalModel::class, 'id_grupo_internacional');
    }
}
