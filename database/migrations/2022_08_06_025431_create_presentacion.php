<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('invitado');
            $table->unsignedBigInteger('socio');
            $table->string("tipo");
            $table->string('dia');
            $table->date('fecha');
            $table->foreign('usuario')
                ->references('id')
                ->on('users');
            $table->foreign('invitado')
                ->references('id')
                ->on('invitado');
            $table->foreign('socio')
                ->references('id')
                ->on('socios');
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
        Schema::dropIfExists('table_presentacion');
    }
}
