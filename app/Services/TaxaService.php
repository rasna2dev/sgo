<?php

namespace App\Services;

use App\Repositories\TaxaRepository;

class TaxaService
{
    protected $taxaRepository;

    public function __construct(TaxaRepository $taxaRepository)
    {
        $this->taxaRepository = $taxaRepository;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->taxaRepository->updateOrCreate($conditions, $data);
    }

    public function buscarTaxa(array $data = [])
    {
        return $this->taxaRepository->search($data);
    }
}
