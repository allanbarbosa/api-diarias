<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasseGrupoInternacionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classe_grupo_internacional', function (Blueprint $table) {
            $table->bigIncrements('clas_gru_internacional_id');
            $table->decimal('clas_gru_internacional_valor', 10,2);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'classe_grupo_internacional_created_by_idx');
            $table->index('updated_by', 'classe_grupo_internacional_updated_by_idx');
            $table->index('deleted_by', 'classe_grupo_internacional_deleted_by_idx');

            $table->foreign('created_by', 'fk_classe_grupo_internacional_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_classe_grupo_internacional_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_classe_grupo_internacional_deleted_by')
                ->references('usua_id')->on('usuario');

            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_grupo_internacional');

            $table->index('id_classe', 'classe_grupo_internacional_classe_idx');
            $table->index('id_grupo_internacional', 'classe_grupo_internacional_grupo_internacional_idx');

            $table->foreign('id_classe', 'fk_classe_grupo_internacional_id_classe')
                ->references('clas_id')->on('classe');
            $table->foreign('id_grupo_internacional', 'fk_classe_grupo_internacional_id_grupo_internacional')
                ->references('grup_int_id')->on('grupo_internacional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classe_grupo_internacional', function (Blueprint $table) {
            $table->dropForeign('fk_classe_grupo_internacional_created_by');
            $table->dropForeign('fk_classe_grupo_internacional_updated_by');
            $table->dropForeign('fk_classe_grupo_internacional_deleted_by');
            $table->dropForeign('fk_classe_grupo_internacional_id_classe');
            $table->dropForeign('fk_classe_grupo_internacional_id_grupo_internacional');

            $table->dropIndex('classe_grupo_internacional_created_by_idx');
            $table->dropIndex('classe_grupo_internacional_updated_by_idx');
            $table->dropIndex('classe_grupo_internacional_deleted_by_idx');
            $table->dropIndex('classe_grupo_internacional_classe_idx');
            $table->dropIndex('classe_grupo_internacional_grupo_internacional_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');
            $table->dropColumn('id_classe');
            $table->dropColumn('id_grupo_internacional');
            
        });
    }
}
