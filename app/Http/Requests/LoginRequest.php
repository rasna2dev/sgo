<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuario' => 'required|email|max:255',
            'senha' => 'required|min:6|max:64'
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'Informe um nome para o usuário.'
            ,'usuario.email' => 'Informe um e-mail válido.'
            ,'usuario.max' => 'O e-mail deve ter no máximo 255 caracteres.'
            ,'senha.required' => 'Informe uma senha para o usuário.'
            ,'senha.min' => 'A senha deve ter ao menos 6 caracteres.'
            ,'senha.max' => 'A senha deve ter no máximo 64 caracteres.'
        ];
    }
}
