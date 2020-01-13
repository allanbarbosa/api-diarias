<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoMovimentacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_movimentacao', function (Blueprint $table) {
            $table->bigIncrements('hist_mov_id');
            $table->dateTime('hist_mov_data_tramitacao');
            $table->text('hist_mov_observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'historico_movimentacao_created_by_idx');
            $table->index('updated_by', 'historico_movimentacao_updated_by_idx');
            $table->index('deleted_by', 'historico_movimentacao_deleted_by_idx');

            $table->foreign('created_by', 'fk_historico_movimentacao_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_historico_movimentacao_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_historico_movimentacao_deleted_by')->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_movimentacao');
            $table->unsignedBigInteger('id_viagem');
            $table->unsignedBigInteger('id_lotacao');

            $table->index('id_movimentacao', 'historico_movimentacao_movimentacao1_idx');
            $table->index('id_viagem', 'historico_movimentacao_viagem1_idx');
            $table->index('id_lotacao', 'historico_movimentacao_lotacao1_idx');

            $table->foreign('id_movimentacao', 'fk_historico_movimentacao_id_movimentacao')->references('movi_id')->on('movimentacao');
            $table->foreign('id_viagem', 'fk_historico_movimentacao_id_viagem')->references('viag_id')->on('viagem');
            $table->foreign('id_lotacao', 'fk_historico_movimentacao_id_lotacao')->references('lota_id')->on('lotacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_movimentacao');
    }
}
