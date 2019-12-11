<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_perfil', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_perfil');
            
            $table->index('id_usuario', 'usuario_perfil_id_usuario_idx');
            $table->index('id_perfil', 'usuario_perfil_id_perfil_idx');
            
            $table->foreign('id_usuario', 'fk_usuario_perfil_id_usuario')
                ->references('usua_id')->on('usuario');
            $table->foreign('id_perfil', 'fk_usuario_perfil_id_perfil')
                ->references('perf_id')->on('perfil');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_perfil');
    }
}
