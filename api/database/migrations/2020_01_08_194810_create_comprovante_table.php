<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprovante', function (Blueprint $table) {
            $table->bigIncrements('compe_id');
            $table->string('compe_caminho', 255);
            $table->string('compe_nome_arquivo', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'comprovante_created_by_idx');
            $table->index('updated_by', 'comprovante_updated_by_idx');
            $table->index('deleted_by', 'comprovante_deleted_by_idx');

            $table->foreign('created_by', 'fk_comprovante_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_comprovante_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_comprovante_deleted_by')->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_comprovacao');
            $table->unsignedBigInteger('id_tipo_comprovante');

            $table->index('id_comprovacao', 'comprovante_id_comprovacao_idx');
            $table->index('id_tipo_comprovante', 'comprovante_id_tipo_comprovante_idx');

            $table->foreign('id_comprovacao', 'fk_comprovante_id_comprovacao')->references('compo_id')->on('comprovacao');
            $table->foreign('id_tipo_comprovante', 'fk_comprovante_id_tipo_comprovante')->references('tipo_com_id')->on('tipo_comprovante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprovante');
    }
}
