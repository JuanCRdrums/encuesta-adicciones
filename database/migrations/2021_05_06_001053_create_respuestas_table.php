<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_adicciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('datos_usuario');
            $table->text('puntuaciones');
            $table->text('pregunta_1');
            $table->text('pregunta_2');
            $table->text('pregunta_3');
            $table->text('pregunta_4');
            $table->text('pregunta_5');
            $table->text('pregunta_6');
            $table->text('pregunta_7');
            $table->text('pregunta_8');
            $table->text('intervenciones');
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
        Schema::drop('respuestas_adicciones');
    }
}
