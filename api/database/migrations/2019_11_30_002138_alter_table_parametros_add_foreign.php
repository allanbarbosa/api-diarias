<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableParametrosAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parametros', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'parametros_created_by_idx');
            $table->index('updated_by', 'parametros_updated_by_idx');
            $table->index('deleted_by', 'parametros_deleted_by_idx');

            $table->foreign('created_by', 'fk_parametros_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_parametros_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_parametros_deleted_by')
                ->references('usua_id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parametros', function (Blueprint $table) {

            $table->dropForeign('fk_parametros_created_by');
            $table->dropForeign('fk_parametros_updated_by');
            $table->dropForeign('fk_parametros_deleted_by');

            $table->dropIndex('parametros_created_by_idx');
            $table->dropIndex('parametros_updated_by_idx');
            $table->dropIndex('parametros_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
