<?php
declare(strict_types=1);

namespace Diarias\Profissao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfissaoModel extends Model
{
    protected $table = 'profissao';

    protected $primaryKey = 'prof_id';

    protected $fillable = [
        'prof_nome',
        'prof_slug',
    ];

    use SoftDeletes;
}