<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMunicipioAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('municipio', function (Blueprint $table) {
        $table->unsignedBigInteger('created_by');
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->index('created_by', 'municipio_created_by_idx');
        $table->index('updated_by', 'municipio_updated_by_idx');
        $table->index('deleted_by', 'municipio_deleted_by_idx');

        $table->foreign('created_by', 'fk_municipio_created_by')
        ->references('usua_id')->on('usuario');
        $table->foreign('updated_by', 'fk_municipio_updated_by')
        ->references('usua_id')->on('usuario');
        $table->foreign('deleted_by', 'fk_municipio_deleted_by')
        ->references('usua_id')->on('usuario');

        $table->unsignedBigInteger('id_estado');

        $table->index('id_estado', 'municipio_estado1_idx');

        $table->foreign('id_estado', 'fk_municipio_id_estado')
        ->references('esta_id')->on('estado');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('municipio', function (Blueprint $table) {
        $table->dropForeign('fk_municipio_created_by');
        $table->dropForeign('fk_municipio_updated_by');
        $table->dropForeign('fk_municipio_deleted_by');
        $table->dropForeign('fk_municipio_id_estado');

        $table->dropIndex('municipio_created_by_idx');
        $table->dropIndex('municipio_updated_by_idx');
        $table->dropIndex('municipio_deleted_by_idx');
        $table->dropIndex('municipio_estado1_idx');

        $table->dropColumn('created_by');
        $table->dropColumn('updated_by');
        $table->dropColumn('deleted_by');
        $table->dropColumn('id_estado');
      });
    }
}
