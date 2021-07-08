<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('dni',8)->unique();
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->char('estado',1)->default('A');
            $table->string("foto")->nullable();
            $table->integer('cargo_id');
            $table->timestamps();
        });

        DB::table('colaboradores')->insert(
            array(
                'dni' => '12345678',
                'nombres' =>  "Kiara",
                'apellidos' =>  "Baldera",
                'cargo_id' =>  1,
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
        Schema::dropIfExists('colaboradores');
    }
}
