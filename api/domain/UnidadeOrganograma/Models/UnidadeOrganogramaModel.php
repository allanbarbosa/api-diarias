<?php
declare(strict_types=1);

namespace Diarias\UnidadeOrganograma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Unidade\Models\UnidadeModel;
use Diarias\Organograma\Models\OrganogramaModel;
use Diarias\PapelFluxograma\Models\PapelFluxogramaModel;

class UnidadeOrganogramaModel extends Model
{
    protected $table = 'unidade_organograma';

    protected $primaryKey = 'unid_org_id';

    protected $fillable = [
        'id_unidade_pai',
        'id_unidade',
        'id_organograma',
        'id_papel_fluxograma'
    ];

    public function unidade()
    {
        return $this->belongsTo(UnidadeModel::class, 'id_unidade');
    }

    public function unidade_pai()
    {
        return $this->belongsTo(UnidadeModel::class, 'id_unidade_pai');
    }

    public function organograma()
    {
        return $this->belongsTo(OrganogramaModel::class, 'id_organograma');
    }

    public function papel_fluxograma()
    {
        return $this->belongsTo(PapelFluxogramaModel::class, 'id_papel_fluxograma');
    }

    use SoftDeletes;
}
