<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImovelModel extends Model
{
    protected $table = 'imoveis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id', 'matricula_id', 'estado_id', 'cidade_id',
        'bairro_id', 'modalidade_id', 'unidade_id', 'slug', 'endereco',
        'valor_venda', 'valor_avaliacao', 'valor_desconto',
        'imagem', 'area_total', 'area_privativa', 'area_terreno',
        'quartos','banheiros', 'salas', 'vagas_garagem',
        'descricao', 'link', 'link_matricula', 'vendido', 'data_criacao',
        'data_atualizacao', 'principal'
    ];

    public $timestamps = false;
}
