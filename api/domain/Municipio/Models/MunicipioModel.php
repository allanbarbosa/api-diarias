<?php
declare(strict_types=1);

namespace Diarias\Municipio\Models;

use Illuminate\Database\Eloquent\Model;

class MunicipioModel extends Model
{
    protected $table = 'municipio';

    protected $primaryKey = 'id_municipio';

    public $timestamps = false;

    public function estado()
    {
        return $this->belongsTo(EstadoModel::class, 'estado_id_estado');
    }
}
