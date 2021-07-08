<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion", 200);
            $table->string("estado")->default("A");
            $table->timestamps();
        });

        DB::table('categorias')->insert([['descripcion' => 'Intimidación por parte de respondientes'], 
        ['descripcion' => 'Síntomas de ansiedad, depresión, estrés post traumático y efectos sobre autoestima']]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
