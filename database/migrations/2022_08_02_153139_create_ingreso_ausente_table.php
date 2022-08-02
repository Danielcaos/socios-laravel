<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoAusenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_ausente', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula')->unique();
            $table->string('codigo');
            $table->integer('dias');
            $table->date('fecha');
            $table->unsignedBigInteger('usuario');
            $table->foreign('usuario')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('ingreso_ausente');
    }
}
