<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxaModel extends Model
{
    protected $table = 'taxas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id', 'imovel_id', 'valor_mercado',
        'valor_avaliacao', 'valor_arremate', 'valor_desconto',
        'valor_prazo', 'valor_condominio_mensal', 'valor_iptu_mensal',
        'valor_prestacao_mensal', 'valor_entrada', 'valor_documentacao',
        'valor_desocupacao', 'valor_reforma', 'valor_deposito_inicial',
        'valor_prestacao', 'valor_condominio_anual', 'valor_iptu_anual',
        'valor_despesa_venda', 'valor_despesa_extra', 'valor_investimento',
        'valor_saldo_devedor', 'valor_reembolso', 'valor_saldo_operacao',
        'regra', 'ativo', 'data_criacao', 'data_atualizacao'
    ];

    public $timestamps = false;

}
