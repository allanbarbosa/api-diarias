<?php
declare(strict_types=1);

namespace Diarias\Perfil\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilModel extends Model
{
    protected $table = 'perfil';

    protected $primaryKey = 'perf_id';

    protected $fillable = [
        'perf_descricao',
        'perf_slug'
    ];

    use SoftDeletes;
}