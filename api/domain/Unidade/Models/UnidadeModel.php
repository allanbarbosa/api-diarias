<?php
declare(strict_types=1);

namespace Diarias\Unidade\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadeModel extends Model
{
    protected $table = 'unidade';

    protected $primaryKey = 'id_unidade';

    public $timestamps = false;

    public function unidadePai()
    {
        return $this->belongsTo(UnidadeModel::class, 'unidade_pai');
    }
}
