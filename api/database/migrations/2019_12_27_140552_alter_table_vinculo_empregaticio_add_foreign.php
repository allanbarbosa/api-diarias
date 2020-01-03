<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVinculoEmpregaticioAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vinculo_empregaticio', function (Blueprint $table) {
          $table->unsignedBigInteger('id_funcionario');

          $table->index('id_funcionario', 'vinculo_empregaticio_funcionario1_idx');

          $table->foreign('id_funcionario', 'fk_vinculo_empregaticio_id_funcionario')
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
        Schema::table('vinculo_empregaticio', function (Blueprint $table) {
          $table->dropForeign('fk_vinculo_empregaticio_id_funcionario');

          $table->dropIndex('vinculo_empregaticio_funcionario1_idx');

          $table->dropColumn('id_funcionario');
        });
    }
}
