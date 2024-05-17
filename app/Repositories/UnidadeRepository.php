<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\UnidadeModel;

class UnidadeRepository
{
    protected $unidadeModel;

    public function __construct(UnidadeModel $unidadeModel)
    {
        $this->unidadeModel = $unidadeModel;
    }

    public function updateOrCreate(array $data)
    {
        return $this->unidadeModel->updateOrCreate($data);
    }

    public function search(array $data)
    {
        $query = $this->unidadeModel->select('*')
            ->orderBy('nome');

        return $query;
    }
}
