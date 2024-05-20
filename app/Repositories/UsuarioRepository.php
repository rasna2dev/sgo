<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\UsuarioModel;

class UsuarioRepository
{
    protected $usuarioModel;

    public function __construct(UsuarioModel $usuarioModel)
    {
        $this->usuarioModel = $usuarioModel;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->usuarioModel->updateOrCreate($conditions, $data);
    }

    public function search(array $data)
    {
        $query = $this->usuarioModel->select('*');

        if(isset($data['id']) && strlen($data['id']) > 0) {
            $query->where('usuarios.id', $data['id']);
        }

        if(isset($data['usuario']) && strlen($data['usuario']) > 0) {
            $query->where('usuarios.email', $data['usuario']);
        }

        if(isset($data['senha']) && strlen($data['senha']) > 0) {
            $query->where('usuarios.senha', $data['senha']);
        }

        if(isset($data['ativo']) && strlen($data['ativo']) > 0) {
            $query->where('usuarios.ativo', $data['ativo']);
        }


        if(isset($data['pesquisar_uf']) && strlen($data['pesquisar_uf']) > 0) {
            $query->where('usuarios.uf', $data['pesquisar_uf']);
        }

        if(isset($data['pesquisar']) && strlen($data['pesquisar']) > 0) {
            $query->where(function($filter) use ($data) {
                $filter->where('usuarios.nome', 'like', '%'.$data['pesquisar'].'%');
                $filter->orWhere('usuarios.email', 'like', '%'.$data['pesquisar'].'%');
                $filter->orWhere('usuarios.telefone', 'like', '%'.$data['pesquisar'].'%');
            });
        }

        return $query;
    }


}
