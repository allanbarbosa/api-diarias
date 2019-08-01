<?php
declare(strict_types=1);

namespace Diarias\Viagem\Models;

use Diarias\Beneficiario\Models\BeneficiarioModel;
use Diarias\Roteiro\Models\RoteiroModel;
use Illuminate\Database\Eloquent\Model;

class ViagemModel extends Model
{
    protected $table = 'viagem';

    protected $primaryKey = 'id_viagem';

    public $timestamps = false;

    public function roteiro()
    {
        return $this->hasMany(RoteiroModel::class, 'viagem_id_viagem');
    }

    public function beneficiario()
    {
        return $this->belongsTo(BeneficiarioModel::class, 'beneficiario_id_beneficiario');
    }
}
