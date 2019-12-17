<?php
declare(strict_types=1);

namespace Diarias\Pais\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;

class PaisModel extends Model
{
    protected $table = 'pais';

    protected $primaryKey = 'pais_id';

    protected $fillable = [
        'pais_nome',
        'pais_codigo'
    ];

    use SoftDeletes;

    public function grupoInternacional()
    {
        return $this->belongsTo(GrupoInternacionalModel::class, 'id_grupo_internacional');
    }
}
