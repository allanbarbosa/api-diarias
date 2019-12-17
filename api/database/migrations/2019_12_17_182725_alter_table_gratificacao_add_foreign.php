<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGratificacaoAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('gratificacao', function (Blueprint $table) {
        $table->unsignedBigInteger('created_by');
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->index('created_by', 'gratificacao_created_by_idx');
        $table->index('updated_by', 'gratificacao_updated_by_idx');
        $table->index('deleted_by', 'gratificacao_deleted_by_idx');

        $table->foreign('created_by', 'fk_gratificacao_created_by')
          ->references('usua_id')->on('usuario');
        $table->foreign('updated_by', 'fk_gratificacao_updated_by')
          ->references('usua_id')->on('usuario');
        $table->foreign('deleted_by', 'fk_gratificacao_deleted_by')
          ->references('usua_id')->on('usuario');

        $table->unsignedBigInteger('id_classe');

        $table->index('id_classe', 'gratificacao_classe1_idx');

        $table->foreign('id_classe', 'fk_gratificacao_id_classe')
          ->references('clas_id')->on('classe');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gratificacao', function (Blueprint $table) {
          $table->dropForeign('fk_gratificacao_created_by');
          $table->dropForeign('fk_gratificacao_updated_by');
          $table->dropForeign('fk_gratificacao_deleted_by');
          $table->dropForeign('fk_gratificacao_id_classe');

          $table->dropIndex('gratificacao_created_by_idx');
          $table->dropIndex('gratificacao_updated_by_idx');
          $table->dropIndex('gratificacao_deleted_by_idx');
          $table->dropIndex('gratificacao_classe1_idx');

          $table->dropColumn('created_by');
          $table->dropColumn('updated_by');
          $table->dropColumn('deleted_by');
          $table->dropColumn('id_classe');
        });
    }
}
