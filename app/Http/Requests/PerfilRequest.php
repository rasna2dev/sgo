<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'senha' => [
                'required'
                ,'min:2'
                ,'max:64'
                ,function ($attribute, $value, $fail) {
                    if (!empty($this->input('senha')) && $this->input('senha') !== $this->input('resenha')) {
                        $fail('As senhas não coincidem.');
                    }
                }
            ],
            'resenha' => [
                'required_if:senha,!='
            ]
        ];
    }

    public function messages()
    {
        return [
            'senha.required' => 'Informe uma senha para o seu login.'
            ,'senha.min' => 'A senha deve ter ao menos 6 caracteres.'
            ,'senha.max' => 'A senha deve ter no máximo 64 caracteres.'
            ,'senha.confirmed' => 'O campo de confirmação da senha não corresponde.'
            ,'resenha.required_if' => 'O campo resenha é obrigatório quando a senha é preenchida.'
        ];
    }
}
