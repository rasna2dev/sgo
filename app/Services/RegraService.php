<?php

namespace App\Services;

use App\Repositories\RegraRepository;


class RegraService
{
    protected $regraRepository;

    public function __construct(
        RegraRepository $regraRepository
    )
    {
        $this->regraRepository = $regraRepository;
    }

    public function get()
    {
        return $this->regraRepository->get();
    }

    public function listar($rows = 50)
    {
        return $this->get()->paginate($rows);
    }

    public function cadastrar(array $data)
    {
        return $this->regraRepository->create($data);
    }

    public function atualizar(int $id, array $data)
    {
        return $this->regraRepository->update($id, $data);
    }

    public function deletar(int $id)
    {
        return $this->regraRepository->destroy($id);
    }

    public function existe(array $data, int $id = 0)
    {
        return $this->regraRepository->chechExists($id, $data)->first();
    }

    public function buscarRegra(array $data, int $id = 0)
    {
        return $this->regraRepository->search($id, $data);
    }

}
