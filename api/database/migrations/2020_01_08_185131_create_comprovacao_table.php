<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprovacao', function (Blueprint $table) {
            $table->bigIncrements('compo_id');
            $table->float('comp_diarias_utilizadas');
            $table->dateTime('comp_data_hora_saida_efetiva');
            $table->dateTime('comp_data_hora_chegada_efetiva');
            $table->string('comp_atividades_desenvolvidas', 500);
            $table->decimal('comp_saldo_receber', 10,2)->nullable();
            $table->decimal('comp_saldo_restituir', 10,2)->nullable();
            $table->decimal('comp_valor_total', 10,2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'comprovacao_created_by_idx');
            $table->index('updated_by', 'comprovacao_updated_by_idx');
            $table->index('deleted_by', 'comprovacao_deleted_by_idx');

            $table->foreign('created_by', 'fk_comprovacao_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_comprovacao_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_comprovacao_deleted_by')->references('usua_id')->on('usuario');
            
            $table->unsignedBigInteger('id_trecho');

            $table->index('id_trecho', 'funcionario_id_trecho_idx');

            $table->foreign('id_trecho', 'fk_comprovacao_id_trecho')->references('trec_rot_id')->on('trecho_roteiro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprovacao');
    }
}
