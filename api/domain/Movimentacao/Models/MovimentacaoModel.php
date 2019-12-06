<?php
declare(strict_types=1);

namespace Diarias\Movimentacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimentacaoModel extends Model
{
    protected $table = 'movimentacao';

    protected $primaryKey = 'movimentacao';

    protected $fillable = [
        'movi_nome',
        'movi_slug',
    ];

    use SoftDeletes;
}