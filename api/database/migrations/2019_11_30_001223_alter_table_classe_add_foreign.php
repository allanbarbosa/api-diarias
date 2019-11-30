<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableClasseAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classe', function (Blueprint $table) {

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'classe_created_by_idx');
            $table->index('updated_by', 'classe_updated_by_idx');
            $table->index('deleted_by', 'classe_deleted_by_idx');

            $table->foreign('created_by', 'fk_classe_created_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('updated_by', 'fk_classe_updated_by')
                ->references('usua_id')->on('usuario');
            $table->foreign('deleted_by', 'fk_classe_deleted_by')
                ->references('usua_id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classe', function (Blueprint $table) {

            $table->dropForeign('fk_classe_created_by');
            $table->dropForeign('fk_classe_updated_by');
            $table->dropForeign('fk_classe_deleted_by');

            $table->dropIndex('classe_created_by_idx');
            $table->dropIndex('classe_updated_by_idx');
            $table->dropIndex('classe_deleted_by_idx');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');

        });
    }
}
