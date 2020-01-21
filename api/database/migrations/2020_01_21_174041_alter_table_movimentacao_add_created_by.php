<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMovimentacaoAddCreatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimentacao', function (Blueprint $table) {
            
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'movimentacao_created_by_idx');
            $table->index('updated_by', 'movimentacao_updated_by_idx');
            $table->index('deleted_by', 'movimentacao_deleted_by_idx');

            $table->foreign('created_by', 'fk_movimentacao_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_movimentacao_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_movimentacao_deleted_by')->references('usua_id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacao', function (Blueprint $table) {
            //
        });
    }
}
