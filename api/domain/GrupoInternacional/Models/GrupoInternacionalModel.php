<?php
declare(strict_types=1);

namespace Diarias\GrupoInternacional\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoInternacionalModel extends Model
{
    protected $table = 'grupo_internacional';

    protected $primaryKey = 'grup_int_id';

    protected $fillable = [
        'grup_int_codigo',
    ];

    use SoftDeletes;
}