<?php
declare (strict_types = 1);

namespace Diarias\Lotacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Cargo\Models\CargoModel;
use Diarias\UnidadeOrganograma\Models\UnidadeOrganogramaModel;
use Diarias\VinculoEmpregaticio\Models\VinculoEmpregaticioModel;

class LotacaoModel extends Model
{
    protected $table = 'lotacao';

    protected $primaryKey = 'lota_id';

    protected $fillable = [
        'lota_data_inicio',
        'lota_data_fim',
        'id_cargo',
        'id_vinculo_empregaticio',
        'id_unidade_organograma',
    ];

    use SoftDeletes;

    public function cargo()
    {
        return $this->belongsTo(CargoModel::class, 'id_cargo');
    }

    public function vinculo_empregaticio()
    {
        return $this->belongsTo(VinculoEmpregaticioModel::class, 'id_vinculo_empregaticio');
    }

    public function unidade_organograma()
    {
        return $this->belongsTo(UnidadeOrganogramaModel::class, 'id_unidade_organograma');
    }
}
