<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viagem', function (Blueprint $table) {
            $table->bigIncrements('viag_id');
            $table->text('viag_objetivo');
            $table->text('viag_justificativa_feriado_fds')->nullable();
            $table->text('viag_justificativa_reprogramacao')->nullable();
            $table->tinyInteger('viag_flag_alimentacao_custeada')->nullable();
            $table->tinyInteger('viag_flag_adicional_deslocamento');
            $table->tinyInteger('viag_flag_urgente');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'viagem_created_by_idx');
            $table->index('updated_by', 'viagem_updated_by_idx');
            $table->index('deleted_by', 'viagem_deleted_by_idx');


            $table->foreign('created_by', 'fk_viagem_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_viagem_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_viagem_deleted_by')->references('usua_id')->on('usuario');
            
            $table->unsignedBigInteger('id_lotacao');

            $table->index('id_lotacao', 'viagem_lotacao_idx');

            $table->foreign('id_lotacao', 'fk_viagem_lota_id')
                ->references('lota_id')->on('lotacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viagem');
    }
}
