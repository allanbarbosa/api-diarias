<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoInternacionalPaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('grupo_internacional_pais', function (Blueprint $table) {
            $table->bigIncrements('grup_int_pais_id');

            $table->unsignedBigInteger('id_pais');
            $table->unsignedBigInteger('id_grupo_internacional');

            $table->index('id_pais', 'grupo_internacional_pais_id_pais_idx');
            $table->index('id_grupo_internacional', 'grupo_internacional_pais_id_grupo_internacional_idx');

            $table->foreign('id_pais', 'fk_grupo_internacional_pais_id_pais')->references('pais_id')->on('pais')->onDelete('cascade');
            $table->foreign('id_grupo_internacional', 'fk_grupo_internacional_pais_id_grupo_internacional')->references('grup_int_id')->on('grupo_internacional')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_internacional_pais');
    }
}
