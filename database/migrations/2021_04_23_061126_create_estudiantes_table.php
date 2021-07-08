<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string("dni", 8);
            $table->string("nombres", 50);
            $table->string("apellidos", 50);
            $table->date("fecha_nacimiento");
            $table->integer('grado_seccion_id');
            $table->json("apoderado")->nullable();
            $table->timestamps();
        });

        DB::table('estudiantes')->insert(
            array(
                'dni' => '12345678',
                'nombres' =>  "Estudiante",
                'apellidos' =>  "Default",
                'grado_seccion_id' =>  1,
                'fecha_nacimiento' =>  date_create("2013-03-15")
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
