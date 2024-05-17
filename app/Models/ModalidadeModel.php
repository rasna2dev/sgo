<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadeModel extends Model
{
    protected $table = 'modalidades';

    protected $primaryKey = 'id';

    protected $fillable = ['slug', 'nome', 'ativo'];

    public $timestamps = false;
}
