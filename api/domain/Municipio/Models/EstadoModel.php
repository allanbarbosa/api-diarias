<?php
declare(strict_types=1);

namespace Diarias\Municipio\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoModel extends Model
{
    protected $table = 'estado';

    protected $primaryKey = 'id_estado';

    public $timestamps = false;
}
