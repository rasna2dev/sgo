<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalidadesTable extends Migration
{
    public function up()
    {
        Schema::create('modalidades', function (Blueprint $table) {
            $table->id();
            $table->char('slug', 100)->nullable();
            $table->index('slug');
            $table->string('nome', 100)->nullable();
            $table->boolean('ativo')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('modalidades');
    }
}
