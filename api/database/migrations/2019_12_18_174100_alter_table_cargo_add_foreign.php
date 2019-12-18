<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCargoAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargo', function (Blueprint $table) {
          $table->unsignedBigInteger('created_by');
          $table->unsignedBigInteger('updated_by')->nullable();
          $table->unsignedBigInteger('deleted_by')->nullable();

          $table->index('created_by', 'cargo_created_by_idx');
          $table->index('updated_by', 'cargo_updated_by_idx');
          $table->index('deleted_by', 'cargo_deleted_by_idx');

          $table->foreign('created_by', 'fk_cargo_created_by')
            ->references('usua_id')->on('usuario');
          $table->foreign('updated_by', 'fk_cargo_updated_by')
            ->references('usua_id')->on('usuario');
          $table->foreign('deleted_by', 'fk_cargo_deleted_by')
            ->references('usua_id')->on('usuario');

          $table->unsignedBigInteger('id_gratificacao');

          $table->index('id_gratificacao', 'cargo_gratificacao1_idx');

          $table->foreign('id_gratificacao', 'fk_cargo_id_gratificacao')
            ->references('grat_id')->on('gratificacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargo', function (Blueprint $table) {
          $table->dropForeign('fk_cargo_created_by');
          $table->dropForeign('fk_cargo_updated_by');
          $table->dropForeign('fk_cargo_deleted_by');
          $table->dropForeign('fk_cargo_id_gratificacao');

          $table->dropIndex('cargo_created_by_idx');
          $table->dropIndex('cargo_updated_by_idx');
          $table->dropIndex('cargo_deleted_by_idx');
          $table->dropIndex('cargo_gratificacao1_idx');

          $table->dropColumn('created_by');
          $table->dropColumn('updated_by');
          $table->dropColumn('deleted_by');
          $table->dropColumn('id_gratificacao');
        });
    }
}
