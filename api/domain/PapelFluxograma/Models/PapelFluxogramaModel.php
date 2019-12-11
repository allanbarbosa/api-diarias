<?php
declare (strict_types=1);

namespace Diarias\PapelFluxograma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PapelFluxogramaModel extends Model
{
    protected $table = 'PapelFluxograma';

    protected $primaryKey = 'pape_flu_id';

    protected $fillable = [
        'pape_flu_slug',
        'pape_flu_descricao'

    ];
use SoftDeletes;
}

