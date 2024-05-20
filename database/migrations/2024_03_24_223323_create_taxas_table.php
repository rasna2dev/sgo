<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('imovel_id')->nullable();
            $table->float('valor_mercado')->nullable();
            $table->float('valor_avaliacao')->nullable();
            $table->float('valor_arremate')->nullable();
            $table->float('valor_desconto')->nullable();
            $table->float('valor_prazo')->nullable();
            $table->float('valor_condominio_mensal')->nullable();
            $table->float('valor_iptu_mensal')->nullable();
            $table->float('valor_prestacao_mensal')->nullable();
            $table->float('valor_entrada')->nullable();
            $table->float('valor_documentacao')->nullable();
            $table->float('valor_desocupacao')->nullable();
            $table->float('valor_reforma')->nullable();
            $table->float('valor_deposito_inicial')->nullable();
            $table->float('valor_prestacao')->nullable();
            $table->float('valor_condominio_anual')->nullable();
            $table->float('valor_iptu_anual')->nullable();
            $table->float('valor_despesa_venda')->nullable();
            $table->float('valor_despesa_extra')->nullable();
            $table->float('valor_investimento')->nullable();
            $table->float('valor_saldo_devedor')->nullable();
            $table->float('valor_reembolso')->nullable();
            $table->float('valor_saldo_operacao')->nullable();
            $table->json('regra')->nullable();
            $table->boolean('ativo')->default(true);
            $table->dateTime('data_criacao')->default(now())->nullable();
            $table->dateTime('data_atualizacao')->default(now())->nullable();

            // Chaves estrangeiras
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('imovel_id')->references('id')->on('imoveis');

            // Índices
            $table->index('usuario_id');
            $table->index('imovel_id');
            $table->index('valor_mercado');
            $table->index('valor_avaliacao');
            $table->index('valor_arremate');
            $table->index('valor_desconto');
            $table->index('valor_prazo');
            $table->index('valor_condominio_mensal');
            $table->index('valor_iptu_mensal');
            $table->index('valor_prestacao_mensal');
            $table->index('valor_entrada');
            $table->index('valor_documentacao');
            $table->index('valor_desocupacao');
            $table->index('valor_reforma');
            $table->index('valor_deposito_inicial');
            $table->index('valor_prestacao');
            $table->index('valor_condominio_anual');
            $table->index('valor_iptu_anual');
            $table->index('valor_despesa_venda');
            $table->index('valor_despesa_extra');
            $table->index('valor_investimento');
            $table->index('valor_saldo_devedor');
            $table->index('valor_reembolso');
            $table->index('valor_saldo_operacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculos');
    }
}
