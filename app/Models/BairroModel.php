<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BairroModel extends Model
{
    protected $table = 'bairros';

    protected $primaryKey = 'id';

    protected $fillable = ['estado_id', 'cidade_id', 'slug', 'nome', 'ativo'];

    public $timestamps = false;


}
