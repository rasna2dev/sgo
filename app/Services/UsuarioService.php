<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{

    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->usuarioRepository->updateOrCreate($conditions, $data);
    }

    public function buscarUsuario(array $data = [])
    {
        return $this->usuarioRepository->search($data);
    }

}
