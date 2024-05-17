<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoModel extends Model
{
    protected $table = 'estados';

    protected $primaryKey = 'id';

    protected $fillable = ['slug', 'sigla', 'nome', 'ativo'];

    public $timestamps = false;
}
