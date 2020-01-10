<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadeOrganogramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_organograma', function (Blueprint $table) {
            
            $table->bigIncrements('unid_org_id');
            
            $table->unsignedBigIncrements('id_unidade');
            $table->unsignedBigIncrements('id_unidade_pai');
            $table->unsignedBigIncrements('id_organograma');
            $table->unsignedBigIncrements('id_papel_fluxograma');

            $table->index('id_unidade', 'unidade_organograma_id_unidade_idx');
            $table->index('id_unidade_pai', 'unidade_organograma_id_unidade_pai_idx');
            $table->index('id_organograma', 'unidade_organograma_id_organograma_idx');
            $table->index('id_papel_fluxograma', 'unidade_organograma_id_papel_fluxograma_idx');

            
            $table->foreign('id_unidade', 'fk_unidade_organograma_id_unidade')->references('unid_id')->on('unidade')->onDelete('cascade');
            $table->foreign('id_unidade_pai', 'fk_unidade_organograma_id_unidade_pai')->references('unid_id')->on('unidade')->onDelete('cascade');
            $table->foreign('id_organograma', 'fk_unidade_organograma_id_organograma')->references('orga_id')->on('organograma')->onDelete('cascade');
            $table->foreign('id_papel_fluxograma', 'fk_unidade_organograma_id_papel_fluxograma')->references('pape_flu_id')->on('papel_fluxograma')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidade_organograma');
    }
}
