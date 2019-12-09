<?php
declare(strict_types=1);

namespace Diarias\Paricularidade\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticularidadeModel extends Model
{
    protected $table = 'particularidade';

    protected $primaryKey = 'part_id';

    protected $fillable = [
        'part_descricao',
        'part_slug',
    ];

    use SoftDeletes;
}