<?php
declare(strict_types=1);

namespace Diarias\Classe\Models;

use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;
use Diarias\Gratificacao\Models\GratificacaoModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClasseModel extends Model
{
    protected $table = 'classe';

    protected $primaryKey = 'clas_id';

    protected $fillable = [
        'clas_nome'
    ];
    
    use SoftDeletes;

    public function gratificacoes()
    {
        return $this->hasMany(GratificacaoModel::class, 'id_classe');
    }

    public function classeGrupoInternacional()
    {
        return $this->hasMany(ClasseGrupoInternacionalModel::class, 'id_classe');
    }
}
