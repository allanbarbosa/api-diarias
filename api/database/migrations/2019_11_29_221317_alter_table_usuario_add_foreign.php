<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsuarioAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'usuario_created_by_idx');
            $table->index('updated_by', 'usuario_updated_by_idx');
            $table->index('deleted_by', 'usuario_deleted_by_idx');

            $table->foreign('created_by', 'fk_usuario_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_usuario_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_usuario_deleted_by')
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
        Schema::table('usuario', function (Blueprint $table) {

            $table->dropForeign('fk_usuario_created_by');
            $table->dropForeign('fk_usuario_updated_by');
            $table->dropForeign('fk_usuario_deleted_by');

            $table->dropIndex('usuario_created_by_idx');
            $table->dropIndex('usuario_updated_by_idx');
            $table->dropIndex('usuario_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
