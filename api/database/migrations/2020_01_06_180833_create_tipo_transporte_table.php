<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('tipo_transporte', function (Blueprint $table) {
            $table->bigIncrements('tipo_tra_id');
            $table->string('tipo_tra_nome', 255);
            $table->string('tipo_tra_slug', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->index('created_by', 'tipo_transporte_created_by_idx');
            $table->index('updated_by', 'tipo_transporte_updated_by_idx');
            $table->index('deleted_by', 'tipo_transporte_deleted_by_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_transporte');
    }
}
