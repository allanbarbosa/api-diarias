<?php
declare(strict_types=1);

namespace Diarias\Lotacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Cargo\Models\CargoModel;

class LotacaoModel extends Model
{
  protected $table = 'lotacao';

  protected $primaryKey = 'lota_id';

  protected $fillable = [
    'lota_data_inicio',
    'lota_data_fim'
  ];

  use SoftDeletes;

  public function cargo()
  {
    return $this->belongsTo(CargoModel::class, 'id_cargo');
  }

  public function vinculoEmpregaticio()
  {
    return $this->belongsTo(vinculoEmpregaticioModel::class, 'id_vinculo_empregaticio');
  }

  public function unidadeOrganograma()
  {
    return $this->belongsTo(UnidadeOrganogramaModel::class, 'id_unidade_organograma');
  }
}
