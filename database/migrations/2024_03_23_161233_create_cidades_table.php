<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration
{
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->char('slug', 255)->nullable();
            $table->index('slug');
            $table->string('nome', 255)->nullable();
            $table->boolean('ativo')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cidades');
    }
}
