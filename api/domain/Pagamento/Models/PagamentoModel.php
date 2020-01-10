<?php
declare(strict_types=1);

namespace Diarias\Pagamento\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoModel extends Model
{
    protected $table = 'pagamento';

    protected $primaryKey = 'paga_id';

    protected $fillable = [
        'paga_numero_pagamento'
    ];

    use SoftDeletes;
}