<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asistencia');
            $table->date('fecha');
            $table->date('fecha_reposicion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
