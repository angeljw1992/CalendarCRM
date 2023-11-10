<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('grupo')->nullable();
            $table->longText('description')->nullable();
            $table->date('due_date')->nullable();
            $table->date('final_date')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_final')->nullable();
            $table->string('dias')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
