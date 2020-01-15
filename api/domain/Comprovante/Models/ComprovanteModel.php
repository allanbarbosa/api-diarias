<?php
declare(strict_types=1);

namespace Diarias\Comprovante\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComprovanteModel extends Model
{
    protected $table = 'comprovante';

    protected $primaryKey = 'compe_id';

    protected $fillable = [
        'comp_caminho',
        'compe_nome_arquivo',
        'id_comprovacao',
        'id_tipo_comprovante',
    ];

    use SoftDeletes;
}