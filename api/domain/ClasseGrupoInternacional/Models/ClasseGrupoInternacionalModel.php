<?php
declare(strict_types=1);

namespace Diarias\ClassGrupoInternacional\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClasseGrupoInternacionalModel extends Model
{
    protected $table = 'classe_grupo_internacional';

    protected $primaryKey = 'clas_gru_internacional_id';

    protected $fillable = [
        'clas_gru_internacional_valor'
    ];

    use SoftDeletes;
}