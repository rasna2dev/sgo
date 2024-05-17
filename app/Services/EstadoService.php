<?php

namespace App\Services;

use App\Repositories\EstadoRepository;
use Illuminate\Support\Facades\Cache;

class EstadoService
{
    protected $estadoRepository;

    public function __construct(EstadoRepository $estadoRepository)
    {
        $this->estadoRepository = $estadoRepository;
    }

    public function updateOrCreate(array $data)
    {
        return $this->estadoRepository->updateOrCreate($data);
    }

    public function getEstado(array $data = [])
    {
        return Cache::remember('temp_estado', now()->addMinutes(10), function () use ($data) {
            return $this->estadoRepository->search($data)->get();
        });
    }

}
