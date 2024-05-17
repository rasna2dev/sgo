<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;
use App\Http\Requests\UsuariosRequest;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends AbstractController
{

    protected $usuarioService;

    public function __construct(
        UsuarioService $usuarioService
    )
    {
        $this->usuarioService = $usuarioService;
        $this->currentRouteName = dir_blade($this->getNomeRota());

    }

    public function index(Request $request)
    {
        return view( $this->currentRouteName . ".index", [
            'title' => 'Usuários / Lista de Cadastrados'
            ,'currentRouteName' => $this->currentRouteName
            ,'usuarios' => $this->usuarioService->buscarUsuario($request->all())->paginate(15)
            ,'estados' => config('estados')
        ]);
    }

    public function store(UsuariosRequest $request)
    {
        $request = $request->only('nome','email','uf','telefone','senha','administrador','ativo');
        $request['nome'] = mb_strtoupper($request['nome']);
        $request['email'] = mb_strtolower($request['email']);
        $request['senha'] = md5($request['senha']);

        $this->usuarioService->updateOrCreate(['email' => $request['email']], $request);

        return response()->json([
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso.',
        ]);
    }

    public function update(UsuariosRequest $request, int $id)
    {
        if($id == 1 && Auth::user()->id <> 1) {
            return response()->json([
                'message' => 'Apenas o administrador pode alterar o próprio perfil.',
                'errors' => [
                    'nome' => ['Apenas o administrador pode alterar o próprio perfil.']
                ]
            ], 422);
        }

        $request = $request->only('nome','email','uf','telefone','senha','administrador','ativo');
        $request['nome'] = mb_strtoupper($request['nome']);
        $request['email'] = mb_strtolower($request['email']);

        if(is_null($request['senha'])) {
            unset($request['senha']);
        } else {
            $request['senha'] = md5($request['senha']);
        }

        $usuario = $this->usuarioService->buscarUsuario(['id' => $id])->first();

        if($usuario) {
            $usuario->update( $request );
        }

        return response()->json([
            'success' => true,
            'message' => 'Usuário atualizado com sucesso.',
        ]);

    }
}
