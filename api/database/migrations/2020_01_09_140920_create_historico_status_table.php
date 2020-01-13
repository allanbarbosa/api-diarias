<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_status', function (Blueprint $table) {
            $table->bigIncrements('hist_sta_id');
            $table->dateTime('hist_sta_data_tramitacao');
            $table->text('hist_sta_observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'historico_status_created_by_idx');
            $table->index('updated_by', 'historico_status_updated_by_idx');
            $table->index('deleted_by', 'historico_status_deleted_by_idx');

            $table->foreign('created_by', 'fk_historico_status_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_historico_status_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_historico_status_deleted_by')->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_viagem');
            $table->unsignedBigInteger('id_lotacao');

            $table->index('id_status', 'historico_status_status1_idx');
            $table->index('id_viagem', 'historico_status_viagem1_idx');
            $table->index('id_lotacao', 'historico_status_lotacao1_idx');

            $table->foreign('id_status', 'fk_historico_status_id_status')->references('stat_id')->on('status');
            $table->foreign('id_viagem', 'fk_historico_status_id_viagem')->references('viag_id')->on('viagem');
            $table->foreign('id_lotacao', 'fk_historico_status_id_lotacao')->references('lota_id')->on('lotacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_status');
    }
}
