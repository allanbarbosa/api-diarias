<?php
declare(strict_types=1);

namespace Diarias\Beneficiario\Models;

use Diarias\Unidade\Models\UnidadeModel;
use Illuminate\Database\Eloquent\Model;

class BeneficiarioModel extends Model
{
    protected $table = 'beneficiario';

    protected $primaryKey = 'id_beneficiario';

    public $timestamps = false;

    public function unidade()
    {
        return $this->belongsTo(UnidadeModel::class, 'unidade_id_unidade');
    }
}
