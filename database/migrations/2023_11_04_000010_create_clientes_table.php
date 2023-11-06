<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('identificacion')->unique();
            $table->date('fecha_nacimiento');
            $table->string('correo');
            $table->integer('telefono');
            $table->string('nivel')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('activo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
