<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('description',1000)->nullable();
            $table->bigInteger('id_asignatura')->unsigned();
            $table->bigInteger('id_archivo')->unsigned();
            $table->timestamps();
            $table->foreign('id_asignatura')
            ->references('id')
            ->on('asignatura')
            ->cascadeOnDelete();
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secciones');
    }
}
