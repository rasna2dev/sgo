<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\UsuarioService;

class UsuariosSeeder extends Seeder
{

    protected $UsuarioService;

    public function __construct(UsuarioService $UsuarioService)
    {
        $this->UsuarioService = $UsuarioService;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ['administrador@gmail.com.br', 'a123b123', 'TESTE ADMINISTRADOR', 'RJ', 'RIO DE JANEIRO', '+5511987654321', true, true],
            ['consultor@gmail.com.br', 'a123b123', 'TESTE CONSULTOR', 'SP', 'SÃO PAULO', '+5511912345678', false, true],
        ];

        foreach ($dados as $dado) {
            $this->UsuarioService->createUsuario([
                'email' => $dado[0],
                'senha' => bcrypt($dado[1]),
                'nome' => $dado[2],
                'uf' => $dado[3],
                'cidade' => $dado[4],
                'telefone' => $dado[5],
                'administrador' => $dado[5],
                'ativo' => $dado[7],
            ]);
        }
    }
}
