<?php

namespace App\Services;

use App\Repositories\UnidadeRepository;
use Illuminate\Support\Facades\Cache;

class UnidadeService
{

    protected $unidadeRepository;

    public function __construct(UnidadeRepository $unidadeRepository)
    {
        $this->unidadeRepository = $unidadeRepository;
    }

    public function updateOrCreate(array $data)
    {
        return $this->unidadeRepository->updateOrCreate($data);
    }

    public function getUnidade(array $data = [])
    {
        return Cache::remember('temp_unidade', now()->addMinutes(10), function () use ($data) {
            return $this->unidadeRepository->search($data)->get();
        });
    }

}
