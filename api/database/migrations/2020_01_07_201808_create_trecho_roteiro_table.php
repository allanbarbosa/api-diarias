<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrechoRoteiroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trecho_roteiro', function (Blueprint $table) {
            
            $table->bigIncrements('trec_rot_id');
            $table->dateTime('trec_rot_data_hora_saida');
            $table->dateTime('trec_rot_data_hora_retorno');
            $table->decimal('trec_rot_valor_unitario', 10,2);
            $table->decimal('trec_rot_valor_adicional', 10,2)->nullable();
            $table->float('trec_rot_qtd_diarias');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'trecho_roteiro_created_by_idx');
            $table->index('updated_by', 'trecho_roteiro_updated_by_idx');
            $table->index('deleted_by', 'trecho_roteiro_deleted_by_idx');

            $table->foreign('created_by', 'fk_trecho_roteiro_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_trecho_roteiro_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_trecho_roteiro_deleted_by')
                ->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_tipo_transporte');
            $table->unsignedBigInteger('id_viagem');
            $table->unsignedBigInteger('id_pais_origem');
            $table->unsignedBigInteger('id_municipio_origem');
            $table->unsignedBigInteger('id_pais_destino');
            $table->unsignedBigInteger('id_municipio_destino');

            $table->index('id_tipo_transporte', 'trecho_roteiro_tipo_transporte1_idx');
            $table->index('id_viagem', 'trecho_roteiro_viagem1_idx');
            $table->index('id_pais_origem', 'trecho_roteiro_pais1_idx');
            $table->index('id_municipio_origem', 'trecho_roteiro_municipio1_idx');
            $table->index('id_pais_destino', 'trecho_roteiro_pais2_idx');
            $table->index('id_municipio_destino', 'trecho_roteiro_municipio2_idx');

            $table->foreign('id_tipo_transporte', 'fk_trecho_roteiro_id_tipo_transporte')
                ->references('tipo_tra_id')->on('tipo_transporte');
            $table->foreign('id_viagem', 'fk_trecho_roteiro_id_viagem')
                ->references('viag_id')->on('viagem');
            $table->foreign('id_pais_origem', 'fk_trecho_roteiro_id_pais_origem')
                ->references('pais_id')->on('pais');
            $table->foreign('id_municipio_origem', 'fk_trecho_roteiro_id_municipio_origem')
                ->references('muni_id')->on('municipio');
            $table->foreign('id_pais_destino', 'fk_trecho_roteiro_id_pais_destino')
                ->references('pais_id')->on('pais');
            $table->foreign('id_municipio_destino', 'fk_trecho_roteiro_id_municipio_destino')
                ->references('muni_id')->on('municipio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trecho_roteiro');
    }
}
