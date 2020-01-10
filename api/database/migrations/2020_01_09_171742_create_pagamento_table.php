<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento', function (Blueprint $table) {
            $table->bigIncrements('paga_id');
            $table->string('paga_numero_pagamento', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'pagamento_created_by_idx');
            $table->index('updated_by', 'pagamento_updated_by_idx');
            $table->index('deleted_by', 'pagamento_deleted_by_idx');

            $table->foreign('created_by', 'fk_pagamento_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_pagamento_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_pagamento_deleted_by')->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_viagem');

            $table->index('id_viagem', 'pagamento_viagem1_idx');

            $table->foreign('id_viagem', 'fk_pagamento_id_viagem')->references('viag_id')->on('viagem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamento');
    }
}
