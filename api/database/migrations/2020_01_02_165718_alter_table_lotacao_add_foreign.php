<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLotacaoAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lotacao', function (Blueprint $table) {
        $table->unsignedBigInteger('id_cargo');
        $table->unsignedBigInteger('id_vinculo_empregaticio');
        $table->unsignedBigInteger('id_unidade_organograma');

        $table->index('id_cargo', 'lotacao_cargo1_idx');
        $table->index('id_vinculo_empregaticio', 'lotacao_vinculo_empregaticio1_idx');
        $table->index('id_unidade_organograma', 'lotacao_unidade_organograma1_idx');

        $table->foreign('id_cargo', 'fk_lotacao_id_cargo')
          ->references('carg_id')->on('cargo');

        $table->foreign('id_vinculo_empregaticio', 'fk_lotacao_id_vinculo_empregaticio')
        ->references('vinc_emp_id')->on('vinculo_empregaticio');

        $table->foreign('id_unidade_organograma', 'fk_lotacao_id_unidade_organograma')
        ->references('unid_org_id')->on('unidade_organograma');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('lotacao', function (Blueprint $table) {
        $table->dropForeign('fk_lotacao_id_cargo');
        $table->dropIndex('lotacao_cargo1_idx');
        $table->dropColumn('id_cargo');

        $table->dropForeign('fk_lotacao_id_vinculo_empregaticio');
        $table->dropIndex('lotacao_vinculo_empregaticio1_idx');
        $table->dropColumn('id_vinculo_empregaticio');

        $table->dropForeign('fk_lotacao_id_unidade_organograma');
        $table->dropIndex('lotacao_unidade_organograma1_idx');
        $table->dropColumn('id_unidade_organograma');
      });
    }
}
