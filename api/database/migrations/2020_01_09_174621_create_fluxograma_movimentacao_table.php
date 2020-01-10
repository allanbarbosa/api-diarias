<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFluxogramaMovimentacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fluxograma_movimentacao', function (Blueprint $table) {
            
            $table->bigIncrements('flux_mov_id');
            
            $table->unsignedBigIncrements('id_movimentacao');
            $table->unsignedBigIncrements('id_status_origem');
            $table->unsignedBigIncrements('id_status_destino');
            $table->unsignedBigIncrements('id_papel_fluxograma_origem');
            $table->unsignedBigIncrements('id_papel_fluxograma_destino');
            
            $table->index('id_movimentacao', 'fluxograma_movimentacao_id_movimentacao_idx');
            $table->index('id_status_origem', 'fluxograma_movimentacao_id_status_origem_idx');
            $table->index('id_status_destino', 'fluxograma_movimentacao_id_status_destino_idx');
            $table->index('id_papel_fluxograma_origem', 'fluxograma_movimentacao_id_papel_fluxograma_origem_idx');
            $table->index('id_papel_fluxograma_destino', 'fluxograma_movimentacao_id_papel_fluxograma_destino_idx');

            $table->foreign('id_movimentacao', 'fk_fluxograma_movimentacao_id_movimentacao')->references('movi_id')->on('movimentacao')->onDelete('cascade');
            $table->foreign('id_status_origem', 'fk_fluxograma_movimentacao_id_status_origem')->references('stat_id')->on('status')->onDelete('cascade');
            $table->foreign('id_status_destino', 'fk_fluxograma_movimentacao_id_status_destino')->references('stat_id')->on('status')->onDelete('cascade');
            $table->foreign('id_papel_fluxograma_origem', 'fk_fluxograma_movimentacao_id_papel_fluxograma_origem')->references('pape_flu_id')->on('papel_fluxograma')->onDelete('cascade');
            $table->foreign('id_papel_fluxograma_destino', 'fk_fluxograma_movimentacao_id_papel_fluxograma_destino')->references('pape_flu_id')->on('papel_fluxograma')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fluxograma_movimentacao');
    }
}
