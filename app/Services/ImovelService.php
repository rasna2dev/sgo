<?php

namespace App\Services;

use App\Repositories\ImovelRepository;

class ImovelService
{

    protected $imovelRepository;

    public function __construct(ImovelRepository $imovelRepository)
    {
        $this->imovelRepository = $imovelRepository;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->imovelRepository->updateOrCreate($conditions, $data);
    }

    public function buscarImovel(array $data = [])
    {
        return $this->search($data);
    }

    public function search(array $data = [])
    {
        return $this->imovelRepository->search($data);
    }
}
