<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->index('email');
            $table->string('senha', 64);
            $table->string('esqueceu_senha', 64)->nullable();
            $table->string('nome', 255)->nullable();
            $table->char('uf', 2)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->index('cidade');
            $table->string('telefone', 20)->nullable();
            $table->boolean('administrador')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamp('data_limite')->nullable()->comment('data limite para validação do hash do esqueceu a senha');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
