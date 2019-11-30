<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProfissaoAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profissao', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'profissao_created_by_idx');
            $table->index('updated_by', 'profissao_updated_by_idx');
            $table->index('deleted_by', 'profissao_deleted_by_idx');

            $table->foreign('created_by', 'fk_profissao_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_profissao_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_profissao_deleted_by')
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
        Schema::table('profissao', function (Blueprint $table) {

            $table->dropForeign('fk_profissao_created_by');
            $table->dropForeign('fk_profissao_updated_by');
            $table->dropForeign('fk_profissao_deleted_by');

            $table->dropIndex('profissao_created_by_idx');
            $table->dropIndex('profissao_updated_by_idx');
            $table->dropIndex('profissao_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
