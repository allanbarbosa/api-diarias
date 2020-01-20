<?php
declare (strict_types=1);

namespace Diarias\PapelFluxograma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PapelFluxogramaModel extends Model
{
    protected $table = 'papel_fluxograma';

    protected $primaryKey = 'pape_flu_id';

    protected $fillable = [
        'pape_flu_descricao',
        'pape_flu_slug',

    ];
    use SoftDeletes;
}

