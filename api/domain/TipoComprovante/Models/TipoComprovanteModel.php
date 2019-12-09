<?php
declare(strict_types=1);

namespace Diarias\TipoComprovante\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoComprovanteModel extends Model
{
    protected $table = 'tipo_comprovante';

    protected $primaryKey = 'tipo_com_id';

    protected $fillable = [
        'tipo_com_nome',
        'tipo_com_slug'
    ];

    use SoftDeletes;
}