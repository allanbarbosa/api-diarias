<?php
declare(strict_types=1);

namespace Diarias\Prerrogativa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrerrogativaModel extends Model
{
    protected $table = 'prerrogativa';

    protected $primaryKey = 'prer_id';

    protected $fillable = [
        'prer_descricao',
        'prer_slug'
    ];

    use SoftDeletes;
}