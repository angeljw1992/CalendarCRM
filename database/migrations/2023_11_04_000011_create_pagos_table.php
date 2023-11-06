<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('concepto');
            $table->decimal('monto', 15, 2);
            $table->string('metodo');
            $table->date('fecha_asignada_de_pago');
            $table->date('fecha');
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }
}
