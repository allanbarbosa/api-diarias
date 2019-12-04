<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFuncionarioAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcionario', function (Blueprint $table) {
            
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'funcionario_created_by_idx');
            $table->index('updated_by', 'funcionario_updated_by_idx');
            $table->index('deleted_by', 'funcionario_deleted_by_idx');

            $table->foreign('created_by', 'fk_funcionario_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_funcionario_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_funcionario_deleted_by')
                ->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_profissao');
            $table->unsignedBigInteger('id_escolaridade');

            $table->index('id_empresa', 'funcionario_empresa1_idx');
            $table->index('id_profissao', 'funcionario_profissao1_idx');
            $table->index('id_escolaridade', 'funcionario_escolaridade1_idx');

            $table->foreign('id_empresa', 'fk_funcionario_id_empresa')
                ->references('empr_id')->on('empresa');
            $table->foreign('id_profissao', 'fk_funcionario_id_profissao')
                ->references('prof_id')->on('profissao');
            $table->foreign('id_escolaridade', 'fk_funcionario_id_escolaridade')
                ->references('esco_id')->on('escolaridade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionario', function (Blueprint $table) {
            
            $table->dropForeign('fk_funcionario_created_by');
            $table->dropForeign('fk_funcionario_updated_by');
            $table->dropForeign('fk_funcionario_deleted_by');
            $table->dropForeign('fk_funcionario_id_empresa');
            $table->dropForeign('fk_funcionario_id_profissao');
            $table->dropForeign('fk_funcionario_id_escolaridade');


            $table->dropIndex('funcionario_created_by_idx');
            $table->dropIndex('funcionario_updated_by_idx');
            $table->dropIndex('funcionario_deleted_by_idx');
            $table->dropIndex('funcionario_empresa1_idx');
            $table->dropIndex('funcionario_profissao1_idx');
            $table->dropIndex('funcionario_escolaridade1_idx');


            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');
            $table->dropColumn('id_empresa');
            $table->dropColumn('id_profissao');
            $table->dropColumn('id_escolaridade');


        });
    }
}
