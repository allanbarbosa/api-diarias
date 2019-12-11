<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsuarioAddForeignKeyFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_funcionario')->nullable();
            
            $table->index('id_funcionario', 'usuario_id_funcionario_idx');
            
            $table->foreign('id_funcionario', 'fk_usuario_id_funcionario')
            ->references('func_id')->on('funcionario');
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
            
            $table->dropIndex('usuario_id_funcionario_idx');
            $table->dropForeign('fk_usuario_id_funcionario');
            $table->dropColumn('id_funcionario');
            
        });
    }
}
