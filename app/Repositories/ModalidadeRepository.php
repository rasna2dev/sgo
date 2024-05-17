<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\ModalidadeModel;

class ModalidadeRepository
{

    protected $modalidadeModel;

    public function __construct(ModalidadeModel $modalidadeModel)
    {
        $this->modalidadeModel = $modalidadeModel;
    }

    public function updateOrCreate(array $data)
    {
        return $this->modalidadeModel->updateOrCreate($data);
    }

}
