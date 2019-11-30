<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEmpresaAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'empresa_created_by_idx');
            $table->index('updated_by', 'empresa_updated_by_idx');
            $table->index('deleted_by', 'empresa_deleted_by_idx');

            $table->foreign('created_by', 'fk_empresa_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_empresa_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_empresa_deleted_by')
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
        Schema::table('empresa', function (Blueprint $table) {

            $table->dropForeign('fk_empresa_created_by');
            $table->dropForeign('fk_empresa_updated_by');
            $table->dropForeign('fk_empresa_deleted_by');

            $table->dropIndex('empresa_created_by_idx');
            $table->dropIndex('empresa_updated_by_idx');
            $table->dropIndex('empresa_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
