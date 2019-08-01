<?php
declare(strict_types=1);

namespace Diarias\Roteiro\Models;

use Diarias\Municipio\Models\MunicipioModel;
use Illuminate\Database\Eloquent\Model;

class RoteiroModel extends Model
{
    protected $table = 'roteiro';

    protected $primaryKey = 'id_roteiro';

    public $timestamps = false;

    public function destino()
    {
        return $this->belongsTo(MunicipioModel::class, 'municipio_id_municipio_destino');
    }
}
