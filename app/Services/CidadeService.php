<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Repositories\CidadeRepository;

class CidadeService
{
    protected $cidadeRepository;

    public function __construct(CidadeRepository $cidadeRepository)
    {
        $this->cidadeRepository = $cidadeRepository;
    }

    public function updateOrCreate(array $data)
    {
        return $this->cidadeRepository->updateOrCreate($data);
    }

    public function buscarCidade(array $data = [])
    {
        return $this->cidadeRepository->search($data);
    }


    public function getCidade(array $data = [])
    {
        $key = isset($data['estado_id']) ? "_".$data['estado_id'] : '';
        return Cache::remember("temp_cidade{$key}", now()->addMinutes(10), function () use ($data) {
            $cidade = $this->buscarCidade( $data )->get();
            if($cidade) {
                return $cidade->pluck('nome', 'id')->toArray();
            }
        });
    }

}
