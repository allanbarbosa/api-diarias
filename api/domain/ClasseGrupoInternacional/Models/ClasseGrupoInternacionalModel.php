<?php
declare(strict_types=1);

namespace Diarias\ClasseGrupoInternacional\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;
use Diarias\Classe\Models\ClasseModel;

class ClasseGrupoInternacionalModel extends Model
{
    protected $table = 'classe_grupo_internacional';

    protected $primaryKey = 'clas_gru_internacional_id';

    protected $fillable = [
        'clas_gru_internacional_valor'
    ];

    use SoftDeletes;
    
    public function classe()
    {
        return $this->belongsTo(ClasseModel::class, 'id_classe');
    }

    public function grupo_internacional()
    {
        return $this->belongsTo(GrupoInternacionalModel::class, 'id_grupo_internacional');
    }
}
