<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoNacionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_nacional', function (Blueprint $table) {
            $table->bigIncrements('grup_nac_id');
            $table->string('grup_nac_codigo', 5)->default('text');
            $table->string('grup_nac_descricao', 500)->nullable()->default('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_nacional');
    }
}
