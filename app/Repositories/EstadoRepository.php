<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\EstadoModel;

class EstadoRepository
{

    protected $estadoModel;

    public function __construct(EstadoModel $estadoModel)
    {
        $this->estadoModel = $estadoModel;
    }

    public function updateOrCreate(array $data)
    {
        return $this->estadoModel->updateOrCreate($data);
    }

    public function search(array $data)
    {
        $query = $this->estadoModel->select('*')
            ->orderBy('nome ASC');

        return $query;
    }

}
