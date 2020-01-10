<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticularidadeTrechoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('particularidade_trecho', function (Blueprint $table) {
            
            $table->bigIncrements('part_tre_id');

            $table->unsignedBigInteger('id_particularidade');
            $table->unsignedBigInteger('id_trecho_roteiro');

            $table->index('id_particularidade', 'particularidade_trecho_id_particularidade_idx');
            $table->index('id_trecho_roteiro', 'particularidade_trecho_id_trecho_roteiro_idx');

            $table->foreign('id_particularidade', 'fk_particularidade_trecho_id_particularidade')->references('part_id')->on('particularidade')->onDelete('cascade');
            $table->foreign('id_trecho_roteiro', 'fk_particularidade_trecho_id_trecho_roteiro')->references('trec_rot_id')->on('trecho_roteiro')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('particularidade_trecho');
    }
}
