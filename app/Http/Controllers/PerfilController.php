<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\PerfilRequest;
use Illuminate\Support\Facades\Auth;

class PerfilController extends AbstractController
{

    protected $usuarioService;

    public function __construct(
        UsuarioService $usuarioService
    )
    {
        $this->usuarioService = $usuarioService;
        $this->currentRouteName = dir_blade($this->getNomeRota());
    }

    public function index()
    {
        return view( $this->currentRouteName . ".index", [
            'title' => 'Minha Conta / Perfil'
            ,'currentRouteName' => $this->currentRouteName
            ,'usuario' => $this->usuarioService->buscarUsuario(['id' => Auth::user()->id])->first()
        ]);
    }

    public function update(PerfilRequest $request, int $id)
    {

        $request['senha'] = md5($request['senha']);

        $usuario = $this->usuarioService->buscarUsuario(['id' => Auth::user()->id])->first();
        if($usuario) {
            $usuario->update($request->only('senha'));
        }

        return redirect()->back()->with('success', 'Senha atualizada com sucesso.');
    }

}
