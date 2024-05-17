<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegraModel extends Model
{
    protected $table = 'regras';

    protected $primaryKey = 'id';

    protected $fillable = [
        'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
        'valor_condominio', 'valor_iptu', 'valor_prestacao_financiamento',
        'valor_entrada', 'valor_documentacao', 'valor_desocupacao',
        'valor_reforma', 'valor_despesa_venda',
        'valor_despesa_extra', 'ativo'
    ];

    public $timestamps = false;

}
