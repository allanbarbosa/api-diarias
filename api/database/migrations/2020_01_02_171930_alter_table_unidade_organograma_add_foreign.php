<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUnidadeOrganogramaAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('unidade_organograma', function (Blueprint $table) {
        $table->unsignedBigInteger('id_unidade');
        $table->index('id_unidade', 'unidade_organograma_unidade1_idx');
        $table->foreign('id_unidade', 'fk_unidade_organograma_id_unidade')
          ->references('unid_id')->on('unidade');

        $table->unsignedBigInteger('id_organograma');
        $table->index('id_organograma', 'unidade_organograma_organograma1_idx');
        $table->foreign('id_organograma', 'fk_unidade_organograma_id_organograma')
          ->references('orga_id')->on('organograma');

        $table->unsignedBigInteger('id_papel_fluxograma');
        $table->index('id_papel_fluxograma', 'unidade_organograma_papel_fluxograma1_idx');
        $table->foreign('id_papel_fluxograma', 'fk_unidade_organograma_id_papel_fluxograma')
          ->references('pape_flu_id')->on('papel_fluxograma');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('unidade_organograma', function (Blueprint $table) {
        $table->dropForeign('fk_unidade_organograma_id_unidade');
        $table->dropIndex('unidade_organograma_unidade1_idx');
        $table->dropColumn('id_unidade');

        $table->dropForeign('fk_unidade_organograma_id_organograma');
        $table->dropIndex('unidade_organograma_organograma1_idx');
        $table->dropColumn('id_organograma');

        $table->dropForeign('fk_unidade_organograma_id_papel_fluxograma');
        $table->dropIndex('unidade_organograma_papel_fluxograma1_idx');
        $table->dropColumn('id_papel_fluxograma');
      });
    }
}
