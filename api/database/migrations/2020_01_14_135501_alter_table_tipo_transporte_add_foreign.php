<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTipoTransporteAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_transporte', function (Blueprint $table) {
            
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'tipo_transporte_created_by_idx');
            $table->index('updated_by', 'tipo_transporte_updated_by_idx');
            $table->index('deleted_by', 'tipo_transporte_deleted_by_idx');

            $table->foreign('created_by', 'fk_tipo_transporte_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_tipo_transporte_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_tipo_transporte_deleted_by')->references('usua_id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_transporte', function (Blueprint $table) {
            //
        });
    }
}
