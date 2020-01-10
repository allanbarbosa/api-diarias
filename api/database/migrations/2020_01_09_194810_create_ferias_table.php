<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias', function (Blueprint $table) {
            $table->bigIncrements('feri_id');
            $table->date('feri_data_inicio');
            $table->date('feri_data_fim');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'ferias_created_by_idx');
            $table->index('updated_by', 'ferias_updated_by_idx');
            $table->index('deleted_by', 'ferias_deleted_by_idx');

            $table->foreign('created_by', 'fk_ferias_created_by')->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_ferias_updated_by')->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_ferias_deleted_by')->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_funcionario');

            $table->index('id_funcionario', 'ferias_funcionario1_idx');

            $table->foreign('id_funcionario', 'fk_ferias_id_funcionario')->references('func_id')->on('funcionario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ferias');
    }
}
