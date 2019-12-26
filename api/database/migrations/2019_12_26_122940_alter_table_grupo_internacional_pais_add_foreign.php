<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGrupoInternacionalPaisAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupo_internacional_pais', function (Blueprint $table) {
          $table->unsignedBigInteger('id_pais');
          $table->unsignedBigInteger('id_grupo_internacional');

          $table->index('id_pais', 'grupo_internacional_pais_pais1_idx');
          $table->index('id_grupo_internacional', 'grupo_internacional_pais_grupo_internacional1_idx');

          $table->foreign('id_pais', 'fk_grupo_internacional_pais_id_pais')
            ->references('pais_id')->on('pais');

          $table->foreign('id_grupo_internacional', 'fk_grupo_internacional_pais_id_grupo_internacional')
            ->references('grup_int_id')->on('grupo_internacional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo_internacional_pais', function (Blueprint $table) {
          $table->dropForeign('fk_grupo_internacional_pais_id_pais');
          $table->dropForeign('fk_grupo_internacional_pais_id_grupo_internacional');

          $table->dropIndex('grupo_internacional_pais_pais1_idx');
          $table->dropIndex('grupo_internacional_pais_grupo_internacional1_idx');

          $table->dropColumn('id_pais');
          $table->dropColumn('id_grupo_internacional');
        });
    }
}
