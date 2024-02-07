<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lista_semanal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('categoria_id');
            $table->integer('semana');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_semanal');
    }
};
