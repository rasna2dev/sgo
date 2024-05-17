<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class UsuarioModel extends Authenticatable
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'email', 'senha', 'esqueceu_senha',
        'nome', 'uf', 'cidade', 'telefone',
        'ativo', 'administrador', 'data_limite'
    ];

    protected $hidden = [
        'senha',
        'esqueceu_senha',
        'cidade',
        'data_limite',
    ];

    public $timestamps = false;

    protected $rememberTokenName = null;

}
