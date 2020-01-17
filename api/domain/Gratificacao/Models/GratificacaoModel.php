<?php
declare(strict_types=1);

namespace Diarias\Gratificacao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\Classe\Models\ClasseModel;

class GratificacaoModel extends Model
{
    protected $table = 'gratificacao';

    protected $primaryKey = 'grat_id';

    protected $fillable = [
        'grat_nome',
        'grat_slug',
        'id_classe',
        'grat_valor_diaria'
    ];

    use SoftDeletes;

    public function classe()
    {
        return $this->belongsTo(ClasseModel::class, 'id_classe');
    }
}
