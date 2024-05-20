<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidadeModel extends Model
{
    protected $table = 'cidades';

    protected $primaryKey = 'id';

    protected $fillable = ['estado_id', 'slug', 'nome', 'ativo'];

    public $timestamps = false;

}
