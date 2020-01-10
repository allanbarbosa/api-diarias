<?php
declare(strict_types=1);

namespace Diarias\Ferias\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeriasModel extends Model
{
    protected $table = 'ferias';

    protected $primaryKey = 'feri_id';

    protected $fillable = [
        'feri_data_inicio',
        'feri_data_fim',
    ];

    use SoftDeletes;
}