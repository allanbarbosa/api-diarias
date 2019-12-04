<?php
declare(strict_types=1);

namespace Diarias\Classe\Models;

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

    }
