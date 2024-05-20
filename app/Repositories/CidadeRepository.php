<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\CidadeModel;

class CidadeRepository
{

    protected $cidadeModel;

    public function __construct(CidadeModel $cidadeModel)
    {
        $this->cidadeModel = $cidadeModel;
    }

    public function updateOrCreate(array $data)
    {
        return $this->cidadeModel->updateOrCreate($data);
    }

    public function search(array $data)
    {
        $query = $this->cidadeModel->select(
            '*'
        );

        if(isset($data['estado_id']))
        {
            $query->where('estado_id', $data['estado_id']);
        }

        $query->orderBy('nome');
        return $query;
    }

}
