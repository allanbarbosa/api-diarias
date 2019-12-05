<?php
declare(strict_types=1);

namespace Diarias\Status\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusModel extends Model
{
    protected $table = 'status';

    protected $primaryKey = 'stat_id';

    protected $fillable = [
        'stat_nome',
        'stat_slug'
    ];

    use SoftDeletes;
}