<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGradoSeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_secciones', function (Blueprint $table) {
            $table->id();
            $table->integer('seccion_id');
            $table->integer('grado_id');
            $table->integer('capacidad');
            $table->timestamps();
        });

        DB::table('grado_secciones')->insert(
            array(
                'seccion_id' => 1,
                'grado_id' => 1,
                'capacidad' => 20,
                
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
        Schema::dropIfExists('grado_secciones');
    }
}
