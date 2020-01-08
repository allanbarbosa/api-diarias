<?php
declare(strict_types=1);

namespace Diarias\TipoTranaporte\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTransporteModel extends Model
{
    protected $table = 'tipo_transporte';

    protected $primaryKey = 'tipo_tra_id';

    protected $fillable = [
        'tipo_tra_nome',
        'tipo_tra_slug'
    ];

    use SoftDeletes;
}
