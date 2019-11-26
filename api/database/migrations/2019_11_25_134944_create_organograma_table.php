<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganogramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organograma', function (Blueprint $table) {
            $table->bigIncrements('orga_id');
            $table->string('orga_codigo', 45)->unique();
            $table->dateTime('orga_data_inicio');
            $table->dateTime('orga_data_fim');
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
        Schema::dropIfExists('organograma');
    }
}
