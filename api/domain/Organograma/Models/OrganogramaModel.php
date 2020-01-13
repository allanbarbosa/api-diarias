<?php

declare(strict_types=1);

namespace Diarias\Organograma\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Diarias\UnidadeOrganograma\Models\UnidadeOrganogramaModel;

class OrganogramaModel extends Model
{
    protected $table = 'organograma';

    protected $primaryKey = 'orga_id';

    protected $fillable = [
        'orga_codigo',
        'orga_data_inicio',
        'orga_data_fim',
    ];

    public function unidade_organogramas()
    {
        return $this->hasMany(UnidadeOrganogramaModel::class, 'id_organograma');
    }

    use SoftDeletes;

}