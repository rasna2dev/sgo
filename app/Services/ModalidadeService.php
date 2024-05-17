<?php

namespace App\Services;

use App\Repositories\ModalidadeRepository;

class ModalidadeService
{
    protected $modalidadeRepository;

    public function __construct(ModalidadeRepository $modalidadeRepository)
    {
        $this->modalidadeRepository = $modalidadeRepository;
    }

    public function updateOrCreate(array $data)
    {
        return $this->modalidadeRepository->updateOrCreate($data);
    }

}
