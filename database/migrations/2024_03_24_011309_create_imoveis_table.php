<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('matricula_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->unsignedBigInteger('cidade_id')->nullable();
            $table->unsignedBigInteger('bairro_id')->nullable();
            $table->unsignedBigInteger('modalidade_id')->nullable();
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->char('slug', 1200)->nullable();
            $table->char('endereco', 500)->nullable();
            $table->float('valor_venda')->nullable();
            $table->float('valor_avaliacao')->nullable();
            $table->float('valor_desconto')->nullable();
            $table->char('imagem')->nullable();
            $table->float('area_total')->nullable();
            $table->float('area_privativa')->nullable();
            $table->float('area_terreno')->nullable();
            $table->float('quartos')->nullable();
            $table->float('banheiros')->nullable();
            $table->float('salas')->nullable();
            $table->float('vagas_garagem')->nullable();
            $table->text('descricao')->nullable();
            $table->char('link', 5000)->nullable();
            $table->char('link_matricula', 5000)->nullable();
            $table->boolean('principal')->default(false);
            $table->boolean('vendido')->default(false);
            $table->dateTime('data_criacao')->default(now());
            $table->dateTime('data_atualizacao')->default(now());

            $table->index('usuario_id');
            $table->index('matricula_id');
            $table->index('estado_id');
            $table->index('cidade_id');
            $table->index('bairro_id');
            $table->index('modalidade_id');
            $table->index('unidade_id');
            $table->index('slug');
            $table->index('valor_venda');
            $table->index('valor_avaliacao');
            $table->index('valor_desconto');
            $table->index('imagem');
            $table->index('area_total');
            $table->index('area_privativa');
            $table->index('area_terreno');
            $table->index('quartos');
            $table->index('banheiros');
            $table->index('salas');
            $table->index('vagas_garagem');
            $table->index('descricao');
            $table->index('link');
            $table->index('vendido');
            $table->index('data_criacao');
            $table->index('data_atualizacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
}
