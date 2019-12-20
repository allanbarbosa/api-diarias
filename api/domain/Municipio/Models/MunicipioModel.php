<?php
declare(strict_types=1);

namespace Diarias\Municipio\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Estado\Models\EstadoModel;

class MunicipioModel extends Model
{
    protected $table = 'municipio';

    protected $primaryKey = 'muni_id';

    protected $fillable = [
        'muni_nome',
        'muni_codigo_ibge',
        'muni_porcentagem_diaria'
    ];

    use SoftDeletes;

    public function estado()
    {
        return $this->belongsTo(EstadoModel::class, 'id_estado');
    }
}
