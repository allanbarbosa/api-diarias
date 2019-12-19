<?php
declare(strict_types=1);

namespace Diarias\Cargo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Gratificacao\Models\GratificacaoModel;

class CargoModel extends Model
{
    protected $table = 'cargo';

    protected $primaryKey = 'carg_id';

    protected $fillable = [
        'carg_nome'
    ];

    use SoftDeletes;

    public function gratificacao()
    {
        return $this->belongsTo(GratificacaoModel::class, 'id_gratificacao');
    }
}
