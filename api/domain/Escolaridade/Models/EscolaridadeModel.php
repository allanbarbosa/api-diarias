<?php
declare(strict_types=1);

namespace Diarias\Escolaridade\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscolaridadeModel extends Model
{
    protected $table = 'escolaridade';

    protected $primaryKey = 'esco_id';

    protected $fillable = [
        'esco_nome',
        'esco_slug',
    ];

    use SoftDeletes;
}