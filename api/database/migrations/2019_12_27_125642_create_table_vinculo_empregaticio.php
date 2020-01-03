<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVinculoEmpregaticio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculo_empregaticio', function (Blueprint $table) {
            $table->bigIncrements('vinc_emp_id');
            $table->string('vinc_emp_matricula', 15)->unique();
            $table->dateTime('vinc_emp_data_admissao');
            $table->dateTime('vinc_emp_data_desligamento')->nullable();
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
        Schema::dropIfExists('vinculo_empregaticio');
    }
}
