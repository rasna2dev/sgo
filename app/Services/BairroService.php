<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Repositories\BairroRepository;

class BairroService
{

    protected $bairroRepository;

    public function __construct(BairroRepository $bairroRepository)
    {
        $this->bairroRepository = $bairroRepository;
    }

    public function updateOrCreate(array $data)
    {
        return $this->bairroRepository->updateOrCreate($data);
    }

    public function buscarBairro(array $data = [])
    {
        return $this->bairroRepository->search($data);
    }

    public function getBairro(array $data = [])
    {
        $key = isset($data['cidade_id']) ? "_".$data['cidade_id'] : '';
        return Cache::remember("temp_bairro{$key}", now()->addMinutes(10), function () use ($data) {
            $bairro = $this->buscarBairro( $data )->get();
            if($bairro) {
                return $bairro->pluck('nome', 'id')->toArray();
            }
        });
    }
}
