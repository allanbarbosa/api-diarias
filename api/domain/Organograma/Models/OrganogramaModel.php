<?php

declare(strict_types=1);

namespace Diarias\Organograma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganogramaModel extends Model
{
    protected $table = 'Organograma';

    protected $primaryKey = 'orga_id';

    protected $fillable = [
        'orga_codigo',
        'orga_data_inicio',
        'orga_data_fim'
    ];

    use SoftDeletes;

}