<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAsistenciaTable extends Migration
{
    public function up()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->foreign('estudiante_id', 'estudiante_fk_9177224')->references('id')->on('clientes');
        });
    }
}
