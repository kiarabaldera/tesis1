<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('diagnostico_id');
            $table->integer('pregunta_id');
            $table->string('opcion_seleccionada', 50);
            $table->integer("puntaje");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta_tests');
    }
}
