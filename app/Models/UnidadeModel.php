<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadeModel extends Model
{
    protected $table = 'unidades';

    protected $primaryKey = 'id';

    protected $fillable = ['slug', 'nome', 'ativo'];

    public $timestamps = false;
}
