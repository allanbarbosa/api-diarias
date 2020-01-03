<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionarioPrerrogativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_prerrogativa', function (Blueprint $table)
        {
            $table->bigIncrements('func_pre_id');
            $table->date('func_pre_data_inicio');
            $table->date('func_pre_data_fim');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'funcionario_prerrogativa_created_by_idx');
            $table->index('updated_by', 'funcionario_prerrogativa_updated_by_idx');
            $table->index('deleted_by', 'funcionario_prerrogativa_deleted_by_idx');

            $table->foreign('created_by', 'fk_funcionario_prerrogativa_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_funcionario_prerrogativa_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_funcionario_prerrogativa_deleted_by')
                ->references('usua_id')->on('usuario');
            
            $table->unsignedBigInteger('id_funcionario');
            $table->unsignedBigInteger('id_prerrogativa');
            
            $table->index('id_funcionario', 'funcionario_prerrogativa_funcionario_idx');
            $table->index('id_prerrogativa', 'funcionario_prerrogativa_prerrogativa_idx');

            $table->foreign('id_funcionario', 'fk_funcionario_prerrogativa_id_funcionario')
                ->references('func_id')->on('funcionario');
            $table->foreign('id_prerrogativa', 'fk_funcionario_prerrogativa_id_prerrogativa')
                ->references('prer_id')->on('prerrogativa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario_prerrogativa');
    }
}
