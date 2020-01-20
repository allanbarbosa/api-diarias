<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEscolaridadeAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escolaridade', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'escolaridade_created_by_idx');
            $table->index('updated_by', 'escolaridade_updated_by_idx');
            $table->index('deleted_by', 'escolaridade_deleted_by_idx');

            $table->foreign('created_by', 'fk_escolaridade_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_escolaridade_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_escolaridade_deleted_by')->references('usua_id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escolaridade', function (Blueprint $table) {

            $table->dropForeign('fk_escolaridade_created_by');
            $table->dropForeign('fk_escolaridade_updated_by');
            $table->dropForeign('fk_escolaridade_deleted_by');

            $table->dropIndex('escolaridade_created_by_idx');
            $table->dropIndex('escolaridade_updated_by_idx');
            $table->dropIndex('escolaridade_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
