<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\BairroModel;

class BairroRepository
{

    protected $bairroModel;

    public function __construct(BairroModel $bairroModel)
    {
        $this->bairroModel = $bairroModel;
    }

    public function updateOrCreate(array $data)
    {
        return $this->bairroModel->updateOrCreate($data);
    }

    public function search(array $data)
    {
        $query = $this->bairroModel->select(
            '*'
        );

        if(isset($data['cidade_id']))
        {
            $query->where('cidade_id', $data['cidade_id']);
        }

        $query->orderBy('nome');
        return $query;
    }

}
