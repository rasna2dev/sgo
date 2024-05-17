<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regras', function (Blueprint $table) {
            $table->id();
            $table->float('valor_prazo')->nullable();
            $table->float('valor_inicial')->nullable();
            $table->float('valor_final')->nullable();
            $table->float('valor_desconto')->nullable();
            $table->float('valor_condominio')->nullable();
            $table->float('valor_iptu')->nullable();
            $table->float('valor_prestacao_financiamento')->nullable();
            $table->float('valor_entrada')->nullable();
            $table->float('valor_documentacao')->nullable();
            $table->float('valor_desocupacao')->nullable();
            $table->float('valor_reforma')->nullable();
            $table->float('valor_despesa_venda')->nullable();
            $table->float('valor_despesa_extra')->nullable();
            $table->boolean('ativo')->default(true);

            // Índices adicionais
            $table->index('valor_prazo');
            $table->index('valor_inicial');
            $table->index('valor_final');
            $table->index('valor_desconto');
            $table->index('valor_condominio');
            $table->index('valor_iptu');
            $table->index('valor_prestacao_financiamento');
            $table->index('valor_entrada');
            $table->index('valor_documentacao');
            $table->index('valor_desocupacao');
            $table->index('valor_reforma');
            $table->index('valor_despesa_venda');
            $table->index('valor_despesa_extra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regras');
    }
}
