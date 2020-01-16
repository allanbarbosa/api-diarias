<?php
declare(strict_types=1);

namespace Diarias\Unidade\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadeModel extends Model
{
    protected $table = 'unidade';

    protected $primaryKey = 'unid_id';

    protected $fillable = [
        'unid_nome',
        'unid_sigla',
    ];

    use SoftDeletes;
}
