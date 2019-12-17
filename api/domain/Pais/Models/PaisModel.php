<?php
declare(strict_types=1);

namespace Diarias\Pais\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaisModel extends Model
{
  protected $table = 'pais';

  protected $primaryKey = 'pais_id';

  protected $fillable = [
      'pais_nome',
      'pais_codigo'
  ];

  use SoftDeletes;
}
