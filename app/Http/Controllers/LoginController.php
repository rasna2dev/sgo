<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends AbstractController
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
        if(Auth::check()) {
            return redirect()->route('sgo.imoveis.index');
        }

        return view('sgo.index');
    }

    public function validar(LoginRequest $request)
    {
        $data = $request->only('usuario','senha');
        $data['usuario'] = mb_strtolower( $data['usuario'] );
        $data['senha'] = md5($data['senha']);
        $data['ativo'] = 1;

        $usuario = $this->usuarioService->buscarUsuario($data)->first();

        if($usuario) {

            foreach(['senha','esqueceu_senha','cidade','ativo','data_valida_esqueceu_senha'] as $r) {
                unset($usuario->{$r});
            }

            Auth::login($usuario, true);

            return redirect()->route('sgo.imoveis.index');
        }

        return redirect()->back()
                ->withInput($request->except('senha'))
                ->withErrors(['Usuário não encontrado.']);
    }

    public function sair()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
